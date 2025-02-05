<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;

class Request extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'user_id',
        'pet_id',
        'request_type_id',
        'handling_type_id',
        'status',
        'details',
        'description'
    ];

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function pet(): BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function requestType(): BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(RequestType::class, 'request_type_id');
    }

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function handlingType(): BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(HandlingType::class, 'handling_type_id');
    }
}
