<?php

namespace App\Http\Requests\studentRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateProfileRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'mobile' => 'required|unique:users,mobile,' . $this->user()->id,
            'email' => 'required|unique:users,email,' . $this->user()->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'id_number' => 'required',
            'issue_place' => 'required',
            'national_code' => 'required|unique:students,Mid,' . $this->user()->student->id,
            'marital_status' => 'required',
            'education' => 'required',
            'field' => 'required',
            'job' => 'required',
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
