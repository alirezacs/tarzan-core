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
        Schema::create('pets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('birthdate');
            $table->enum('gender', ['male', 'female']);
            $table->string('skin_color');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Pet Category Relation
            $table->uuid('pet_category_id')->nullable();
            $table->foreign('pet_category_id')->references('id')->on('pet_categories')->nullOnDelete();

            // Breed Relation
            $table->uuid('breed_id')->nullable();
            $table->foreign('breed_id')->references('id')->on('breeds')->nullOnDelete();

            // User Relation
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
