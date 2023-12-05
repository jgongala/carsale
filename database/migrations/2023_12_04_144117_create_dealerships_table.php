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
        // Create 'dealerships' table
        Schema::create('dealerships', function (Blueprint $table) {
            $table->id(); // Primary key column
            // Column for the dealership name
            $table->string('dealership_name'); 
            // Nullable foreign key referencing 'users' table
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained(); 
            // Timestamps for created_at and updated_at columns
            $table->timestamps(); 
        });
    
        // Update 'cars' table
        Schema::table('cars', function (Blueprint $table) {
        // Foreign key referencing 'dealerships' table
            $table->foreignIdFor(\App\Models\Dealership::class)->constrained(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Drop foreign key referencing 'dealerships' table
                $table->dropForeignIdFor(\App\Models\Dealership::class)->constrained(); 
            });
        Schema::dropIfExists('dealerships');
    }
};