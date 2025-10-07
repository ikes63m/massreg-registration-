<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key to the Organisation table
            $table->foreignId('organisation_id')->constrained('organisations')->onDelete('cascade');

            // --- FIX: Add the missing columns for a Contact Person ---
            $table->string('first_name', 150); // The column the controller is looking for
            $table->string('last_name', 150);  // The column the controller is looking for
            $table->string('job_title', 150)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 50)->nullable();
            // --- END FIX ---
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};