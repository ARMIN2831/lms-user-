<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequests\ChangePasswordRequest;
use App\Http\Requests\UserAuthRequests\CompleteProfileRequest;
use App\Http\Requests\UserAuthRequests\LoginRequest;
use App\Http\Requests\UserAuthRequests\SendOTPForgetPasswordRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{


    function userCheck(Request $request)
    {
        $type = match($request->type) {
            'students' => '2',
            'teachers' => '1',
        };

        $user = User::where('mobile', $request->mobile)->where('user_type_id',$type)->first();
        if ($user) {
            return response()->json([
                'status' => 'success',
                'user' => $user
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => trans('messages.invalid_credentials')
        ], 401);
    }


    function userLogin(LoginRequest $request)
    {
        $request->validated();

        $type = match($request->type) {
            'students' => '2',
            'teachers' => '1',
        };
        $user = User::where('mobile', $request->mobile)->where('user_type_id',$type)->first();
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
        $user = User::where('mobile',$request->mobile)->first();
        if ($user and $user->verified == 0 and $request->type == 'students') {
            User::where('mobile',$request->mobile)->update([
                'verified'=> true,
                'password' => bcrypt($request->nationalCode),
            ]);
            Student::where('users_id',$user->id)->update([
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
                'image' => uploadFile($request->file('profilePhoto')),
            ]);
        }else if ($request->type == 'teachers'){

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
        if ($request->current_user_type == "patient"){
            $user = $request->user()->load(['country']);
            $user->dest_currency_value = null;
            if (isset($user->dest_currency_id) and $user->dest_currency_id) {
                $user->dest_currency_value = changeUserCurrency($user->currency_id,$user->dest_currency_id,$user->wallet);
            }
        }else{
            $user = $request->user();
        }

        $userType = $request->current_user_type;

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'user_type' => $userType
        ]);
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        $email_mobile = $request->email_mobile;
        $isEmail = filter_var($email_mobile, FILTER_VALIDATE_EMAIL);
        $field = $isEmail ? 'email' : 'mobile';
        $model = match($request->type) {
            'doctors' => Doctor::class,
            'patients' => Patient::class,
            'translators' => Translator::class,
            'drivers' => Driver::class,
        };
        $user = $model::where($field,$email_mobile)->first();
        verifyOTPCode($field,$user->id,get_class($user),$request->otp);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => trans('messages.password_changed')
        ]);
    }


    public function SendOTPForgetPassword(SendOTPForgetPasswordRequest $request)
    {
        $request->validated();
        $email_mobile = $request->email_mobile;
        $isEmail = filter_var($email_mobile, FILTER_VALIDATE_EMAIL);
        $field = $isEmail ? 'email' : 'mobile';

        $model = match($request->type) {
            'doctors' => Doctor::class,
            'patients' => Patient::class,
            'translators' => Translator::class,
            'drivers' => Driver::class,
        };

        $user = $model::where($field,$email_mobile)->first();

        sendOTPCode($field,$user->id,get_class($user),$email_mobile);

        return response()->json([
            'status' => 'error',
            'message' => trans('messages.OTP_send'),
            'remaining_time' => 120
        ]);
    }
}
