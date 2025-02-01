<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class HandlingType extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'handling_types';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
}
