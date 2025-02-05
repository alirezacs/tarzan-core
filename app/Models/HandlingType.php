<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HandlingType extends Model
{
    use HasUlids;

    protected $table = 'handling_types';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /**
     * @return BelongsToMany
     */
    public function requestTypes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RequestType::class);
    }
}
