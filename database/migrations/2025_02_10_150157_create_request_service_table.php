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
        Schema::create('request_service', function (Blueprint $table) {
            $table->boolean('is_paid')->default(false);

            // Request Relation
            $table->uuid('request_id');
            $table->foreign('request_id')->references('id')->on('requests')->cascadeOnDelete();

            // Service Relation
            $table->uuid('service_id');
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_service');
    }
};
