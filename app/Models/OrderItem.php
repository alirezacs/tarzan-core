<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItem extends Model
{
    use HasUlids;

    protected $fillable = [
        'orderable_id',
        'orderable_type',
        'order_id',
        'quantity',
        'total_price',
        'total_discount',
        'json',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return MorphTo
     */
    public function orderable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
