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
        Schema::create('handling_type_request_type', function (Blueprint $table) {
            $table->uuid('handling_type_id');
            $table->foreign('handling_type_id')->references('id')->on('handling_types')->cascadeOnDelete();

            $table->uuid('request_type_id');
            $table->foreign('request_type_id')->references('id')->on('request_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handling_type_request_type');
    }
};
