<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use MongoDB\Laravel\Eloquent\Model;

class RequestType extends Model
{
    protected $collection = 'request_types';

    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'handling_types'
    ];

    /**
     * @return HasMany|\MongoDB\Laravel\Relations\HasMany
     */
    public function requests(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function handlingTypes()
    {
        return $this->belongsToMany(HandlingType::class, 'handling_types');
    }
}
