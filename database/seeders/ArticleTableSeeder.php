<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'First Article',
            'short_description' => 'First Article Description',
            'slug' => 'first-article',
            'body' => fake()->text(2000),
            'is_active' => 1,
            'article_category_id' => ArticleCategory::first()->id,
            'author_id' => User::first()->id,
        ]);
    }
}
