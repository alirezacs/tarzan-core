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

            // Veterinarian Relation
            $table->uuid('veterinarian_id')->nullable();
            $table->foreign('veterinarian_id')->references('id')->on('users')->nullOnDelete();

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

            $table->string('total_paid');
            $table->dateTime('handling_date');
            $table->boolean('is_emergency')->default(false);
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
