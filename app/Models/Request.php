<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasUlids;

    protected $fillable = [
        'user_id',
        'pet_id',
        'request_type_id',
        'handling_type_id',
        'status',
        'description',
        'address_id'
    ];

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function user(): BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function pet(): BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * @return BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
     */
    public function request_type(): BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(RequestType::class, 'request_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function handling_type(): BelongsTo
    {
        return $this->belongsTo(HandlingType::class);
    }
}
