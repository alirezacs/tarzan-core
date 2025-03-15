<?php

namespace App\Http\Requests\Api;

use App\Rules\CheckingAddressOwnership;
use App\Rules\CheckingPetOwnership;
use Illuminate\Foundation\Http\FormRequest;

class RequestValidationRequest extends FormRequest
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
        return [
            'pet_id' => ['required', 'exists:pets,id', new CheckingPetOwnership(auth()->user())],
            'request_type_id' => ['required', 'exists:request_types,id'],
            'handling_type_id' => ['required', 'exists:handling_types,id'],
            'description' => ['nullable', 'string'],
            'address_id' => ['required', 'exists:addresses,id', new CheckingAddressOwnership(auth()->user())],
            'handling_date' => ['required', 'date'],
            'is_emergency' => ['required', 'boolean'],
        ];
    }
}
