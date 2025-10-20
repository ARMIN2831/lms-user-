<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequests\CompleteProfileRequest;
use App\Http\Requests\UserAuthRequests\LoginRequest;
use App\Http\Requests\UserAuthRequests\VerifyOTPRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    use FileUploadTrait;


    function userCheck(Request $request)
    {
        /*$type = match($request->type) {
            'students' => '2',
            'teachers' => '1',
        };*/

        //$user = User::where('mobile', $request->mobile)->where('user_type_id',$type)->first();
        $user = User::where('nationalCode', $request->nationalCode)->first();
        if ($user) {
            if ($user->verified == 1){
                return response()->json([
                    'status' => 'success',
                    'verified' => $user->verified,
                ]);
            }
            sendOTPCode("mobile",$user->id,get_class($user),$user->mobile);
            User::where('nationalCode',$request->nationalCode)->update(['verify_otp' => 0]);
            return response()->json([
                'status' => 'success',
                'message' => trans('messages.OTP_send'),
                'remaining_time' => 120,
                'verified' => 0,
            ]);
        }


        return response()->json([
            'status' => 'error',
            'message' => trans('messages.invalid_credentials')
        ], 401);
    }


    public function verifyOtp(VerifyOTPRequest $request)
    {
        $request->validated();

        $user = User::where('nationalCode',$request->nationalCode)->first();
        if (!$user){
            return response()->json([
                'status' => 'error',
                'message' => trans('messages.invalid_credentials')
            ], 401);
        }
        verifyOTPCode('mobile',$user->id,get_class($user),$request->code);
        User::where('nationalCode',$request->nationalCode)->update(['verify_otp' => 1]);

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.registration_successful'),
        ], 201);
    }

    function userLogin(LoginRequest $request)
    {
        $request->validated();

        /*$type = match($request->type) {
            'students' => '2',
            'teachers' => '1',
        };*/
        //$user = User::where('mobile', $request->mobile)->where('user_type_id',$type)->first();
        $user = User::where('nationalCode', $request->nationalCode)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->verified == 1){
                return response()->json([
                    'status' => 'success',
                    'message' => trans('messages.login_successful'),
                    'access_token' => $user->createToken('auth_token')->plainTextToken,
                    'user_type' => $request->type,
                    'token_type' => 'Bearer',
                    'user' => $user
                ]);
            }

        }

        return response()->json([
            'status' => 'error',
            'message' => trans('messages.invalid_credentials')
        ], 401);
    }


    public function completeProfile(CompleteProfileRequest $request)
    {
        $request->validated();
        $user = User::where('nationalCode',$request->nationalCode)->first();
        if ($user and $user->verified == 0 and $user->verify_otp == 1){
            $userData = [
                'name' => $request->firstName,
                'family' => $request->lastName,
                'father' => $request->fatherName,
                'Pno' => $request->idNumber,
                'sodor' => $request->issuePlace,
                'Mid' => $request->nationalCode,
                'married' => $request->maritalStatus,
                'madrak' => $request->education,
                'field' => $request->field,
                'job' => $request->job,
                'image' => $this->uploadFile($request->file('profilePhoto')),
            ];
            User::where('nationalCode',$request->nationalCode)->update([
                'verified'=> 1,
                'password' => bcrypt($request->nationalCode),
            ]);
            if ($user->user_type_id == 2) Student::where('users_id',$user->id)->update($userData);
            if ($user->user_type_id == 1) Teacher::where('users_id',$user->id)->update($userData);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => trans('messages.invalid_credentials')
            ], 401);
        }


        return response()->json([
            'status' => 'success',
            'message' => trans('messages.profile_updated'),
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'user_type' => $request->type,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }


    function logout()
    {
        request()->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'successful',
            'message' => 'logged out'
        ]);
    }


    public function getUser(Request $request)
    {
        $user = $request->user();
        if ($user->user_type_id == 2) $user = $user->load('student');
        if ($user->user_type_id == 1) $user = $user->load('teacher');
        return response()->json([
            'message' => 'success',
            'user' => $user,
        ]);
    }
}
