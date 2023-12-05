<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => fake()->randomElement(Car::$make),
            'model' => fake()->word,
            'year' => fake()->numberBetween(1990, 2023),
            'state'=> fake()->randomElement(Car::$state),
            'price'=> fake()->numberBetween(0, 100000), 
            'mileage' => fake()->numberBetween(0, 100000),
            'registration' => fake()->unique()->regexify('[A-Z0-9]{6}'),
            'location' => fake()->city,
            'bodyType' => fake()->randomElement(Car::$bodyType),
        ];
    }
}