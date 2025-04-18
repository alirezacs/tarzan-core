<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'login_type' => ['required', 'in:phone,password']
        ];

        if($this->input('login_type') === 'phone') {
            $rules['phone'] = ['required', 'exists:users,phone'];
        }else{
            $rules['phone'] = ['required', 'exists:users,phone'];
            $rules['password'] = ['required', 'string', 'max:255'];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::make($validator->errors(), 422));
    }
}
