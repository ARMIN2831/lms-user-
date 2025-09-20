<?php

namespace App\Http\Requests\UserAuthRequests;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class CompleteProfileRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $user = User::where('mobile',$this->mobile)->first();
        $type = match($user->user_type_id) {
            2 => 'students',
            1 => 'teachers',
        };
        $model = [];
        if ($user){
            $model = match($type) {
                'students' => Student::class,
                'teachers' => Teacher::class,
            };
        }
        if ($user) $model = $model::where('users_id',$user->id)->first();
        return [
            'mobile' => 'required|exists:users,mobile',
            'firstName' => 'required',
            'lastName' => 'required',
            'fatherName' => 'required',
            'idNumber' => 'required',
            'issuePlace' => 'required',
            'nationalCode' => 'required|unique:'. $type .',Mid,'.$model->id,
            'maritalStatus' => 'required',
            'education' => 'required',
            'field' => 'required',
            'job' => 'required',
            'profilePhoto' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'login failed',
                'message' => $validator->errors()->first(),
            ], 422)
        );
    }
}
