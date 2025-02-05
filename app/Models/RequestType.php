<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    use HasUlids;

    protected $table = 'request_types';

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    /**
     * @return BelongsToMany
     */
    public function handlingTypes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(HandlingType::class, 'handling_type_request_type');
    }

    /**
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
