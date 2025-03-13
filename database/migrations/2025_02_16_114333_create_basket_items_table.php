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
        Schema::create('basket_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Basket Relation
            $table->uuid('basket_id');
            $table->foreign('basket_id')->references('id')->on('baskets')->cascadeOnDelete();

            // Product Relation
            $table->uuidMorphs('basketable');

            $table->bigInteger('quantity')->default(1);
            $table->string('total_price');
            $table->string('total_discount')->nullable();
            $table->timestamps();

            $table->unique(['basket_id', 'basketable_type', 'basketable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_items');
    }
};
