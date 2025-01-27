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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('price');
            $table->bigInteger('stock');
            $table->boolean('is_active')->default(true);

            // Parent Product Relation
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

            // Color Relation
            $table->uuid('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->nullOnDelete();

            // Size Relation
            $table->uuid('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
