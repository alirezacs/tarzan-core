<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'rgb'
    ];
}
