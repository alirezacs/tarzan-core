<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class HandlingType extends Model
{
    use HasUlids;

    protected $table = 'handling_types';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
}
