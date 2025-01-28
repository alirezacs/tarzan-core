<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'is_active'
    ];
}
