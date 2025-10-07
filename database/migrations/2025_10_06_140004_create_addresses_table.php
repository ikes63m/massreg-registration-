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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            // Foreign Key to the 'organisations' table
            $table->foreignId('organisation_id')
                  ->constrained('organisations')
                  ->onDelete('cascade');
            
            // Address Fields
            $table->string('building_name', 200)->nullable();
            $table->string('street_address', 255)->index();
            $table->string('city', 150);
            $table->string('postal_code', 50)->nullable();
            $table->string('country', 150);

            // Status and Timestamps
            $table->boolean('is_active')->default(true); 
            
            // $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};