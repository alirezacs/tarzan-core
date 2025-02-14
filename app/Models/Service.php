<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasUlids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active',
    ];

    /**
     * @return BelongsToMany
     */
    public function requests(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Request::class);
    }
}
