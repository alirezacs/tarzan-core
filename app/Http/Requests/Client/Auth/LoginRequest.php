<?php

namespace App\Http\Requests\Client\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
}
