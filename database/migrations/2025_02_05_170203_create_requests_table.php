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
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // User Relation
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            // Pet Relation
            $table->uuid('pet_id')->nullable();
            $table->foreign('pet_id')->references('id')->on('pets')->nullOnDelete();

            // Request Type Relation
            $table->uuid('request_type_id');
            $table->foreign('request_type_id')->references('id')->on('request_types')->cascadeOnDelete();

            // Handling Type Relation
            $table->uuid('handling_type_id')->nullable();
            $table->foreign('handling_type_id')->references('id')->on('handling_types');

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'completed',
                'canceled',
            ]);
            $table->text('description')->nullable();

            // Address Relation
            $table->uuid('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->nullOnDelete();

            $table->string('min_price');
            $table->string('total_paid');
            $table->string('max_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
