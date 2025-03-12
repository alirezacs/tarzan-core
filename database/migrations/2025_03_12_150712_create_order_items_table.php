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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Product Variant Relation
            $table->uuid('product_variant_id')->nullable();
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->nullOnDelete();

            // Order Relation
            $table->uuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();

            $table->bigInteger('quantity');
            $table->string('total_price');
            $table->string('total_discount')->nullable();
            $table->json('json');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
