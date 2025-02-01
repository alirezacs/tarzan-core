<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class RequestType extends Model
{
    protected $collection = 'request_types';

    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
}
