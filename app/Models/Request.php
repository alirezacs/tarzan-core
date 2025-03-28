<?php

namespace App\Models;

use App\Observers\RequestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Log;

#[ObservedBy(RequestObserver::class)]
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
        'address_id',
        'min_price',
        'total_paid',
        'max_price',
        'handling_date',
        'is_emergency',
        'veterinarian_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return BelongsTo
     */
    public function veterinarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'veterinarian_id');
    }

    /**
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * @return BelongsTo
     */
    public function request_type(): BelongsTo
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

    /**
     * @return BelongsToMany
     */
    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('is_paid');
    }
}
