<?php

namespace App\Rules;

use App\Models\ProductVariant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistsQuantity implements ValidationRule
{
    public function __construct(public string $productVariant)
    {

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product = ProductVariant::query()->find($this->productVariant);

        if($product->stock < $value){
            $fail('تعداد مورد نظر در انبار موجود نمیباشد');
        }
    }
}
