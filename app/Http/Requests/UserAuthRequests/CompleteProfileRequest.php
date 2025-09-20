<?php

namespace App\Http\Requests\UserAuthRequests;

use App\Models\Student;
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
        $rules = [
            'type' => 'required|in:students,teachers',
        ];
        $user = User::where('mobile',$this->mobile)->first();
        if ($user) $student = Student::where('users_id',$user->id)->first();
        if ($this->type === 'students') {
            $rules['mobile'] = 'required|exists:users,mobile';
            $rules['firstName'] = 'required';
            $rules['lastName'] = 'required';
            $rules['fatherName'] = 'required';
            $rules['idNumber'] = 'required';
            $rules['issuePlace'] = 'required';
            $rules['nationalCode'] = 'required|unique:'. $this->type .',Mid,'.$student->id;
            $rules['maritalStatus'] = 'required';
            $rules['education'] = 'required';
            $rules['field'] = 'required';
            $rules['job'] = 'required';
            $rules['profilePhoto'] = 'required|image|mimes:jpeg,png,jpg';
        }
        if ($this->type === 'customers') {

        }

        return $rules;
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
