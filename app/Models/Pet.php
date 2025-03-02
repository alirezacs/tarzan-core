<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pet extends Model implements HasMedia
{
    use HasUuids, InteractsWithMedia;

    protected $connection = 'mysql';

    protected $fillable = [
        'name',
        'birthdate',
        'gender',
        'skin_color',
        'is_active',
        'pet_category_id',
        'breed_id',
        'user_id',
    ];

    protected $with = ['media'];

    /**
     * @return BelongsTo
     */
    public function PetCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PetCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function Breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
