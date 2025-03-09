<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('short_description');
            $table->string('slug')->unique();
            $table->text('body');
            $table->boolean('is_active')->default(true);

            // Article Category Relation
            $table->uuid('article_category_id')->nullable();
            $table->foreign('article_category_id')->references('id')->on('article_categories')->cascadeOnDelete();

            // Created By
            $table->uuid('author_id');
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
