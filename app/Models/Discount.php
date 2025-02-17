<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasUlids;

    protected $fillable = [
        'title',
        'description',
        'expired_at',
        'discount_type',
        'discount_value',
        'is_active',
    ];
}
