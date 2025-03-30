<?php

namespace App\Http\Requests\Client;

use App\Rules\ExistsQuantity;
use Illuminate\Foundation\Http\FormRequest;

class BasketItemRequest extends FormRequest
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
            'type' => ['required', 'in:product_variant,request']
        ];
        if($this->input('type') == 'product_variant') {
            $rules['product_variant_id'] = ['required', 'exists:product_variants,id'];
            $rules['quantity'] = ['required', 'integer', 'min:1', new ExistsQuantity($this->input('product_variant_id'))];
        }else{
            $rules['request_id'] = ['required', 'exists:requests,id'];
        }
        return $rules;
    }
}
