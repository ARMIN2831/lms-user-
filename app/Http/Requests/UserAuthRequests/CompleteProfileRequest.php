<?php

namespace App\Http\Requests\UserAuthRequests;

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

        if ($this->type === 'providers') {
            $rules['mobile'] = 'required|exists:users,mobile';
            $rules['firstName'] = 'required';
            $rules['lastName'] = 'required';
            $rules['fatherName'] = 'required';
            $rules['idNumber'] = 'required';
            $rules['issuePlace'] = 'required';
            $rules['nationalCode'] = 'required|unique:'. $this->type .',nationalCode';
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
