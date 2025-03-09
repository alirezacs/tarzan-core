<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasUlids;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class);
    }
}
