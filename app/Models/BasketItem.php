<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class BasketItem extends Model
{
    use HasUlids;

    protected $fillable = [
        'basketable_type',
        'basketable_id',
        'basket_id',
        'quantity',
        'total_price',
        'total_discount',
    ];

    /**
     * @return MorphTo
     */
    public function basketable(): MorphTo
    {
        return $this->morphTo();
    }
}
