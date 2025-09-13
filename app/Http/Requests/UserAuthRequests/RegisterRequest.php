<?php

namespace App\Http\Requests\UserAuthRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class RegisterRequest extends FormRequest
{
    public bool $isEmail;


    public function authorize(): bool
    {
        return true;
    }


    protected function prepareForValidation()
    {
        $this->isEmail = filter_var($this->email_mobile, FILTER_VALIDATE_EMAIL);
    }


    public function rules(): array
    {
        $rules = [
            'type' => 'required|in:doctors,patients,translators,drivers',
            'email_mobile' => ['required'],
            'password' => 'required|min:8|max:16',
            'name' => 'required|string',
        ];
        if (in_array($this->type, ['doctors', 'patients', 'translators'])) {
            $rules['currency_id'] = 'required|string|exists:currencies,id';
        }
        if ($this->type === 'drivers') {
            $rules['city_id'] = 'required|string|exists:cities,id';
            $rules['car_type'] = 'required|string';
        }
        $rules['email_mobile'][] = $this->isEmail
            ? 'email|unique:' . $this->type . ',email'
            : 'unique:' . $this->type . ',mobile';

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
