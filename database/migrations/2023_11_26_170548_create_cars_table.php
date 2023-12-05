<?php

use App\Models\Car;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->unsignedInteger('price');
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('mileage');
            $table->string('registration')->unique();
            $table->string('location');
            $table->enum('state', Car::$state);
            $table->enum('bodyType', Car::$bodyType);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};