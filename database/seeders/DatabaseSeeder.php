<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 20 users using the User factory
        \App\Models\User::factory(20)->create();

        // Shuffle the users to randomize the order
        $users = \App\Models\User::all()->shuffle();

        // Create 10 dealerships, associating each with a user
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Dealership::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }

        // Retrieve all dealerships
        $dealerships = \App\Models\Dealership::all();

        // Create 50 cars, associating each with a random dealership
        for ($i = 0; $i < 500; $i++) {
            \App\Models\Car::factory()->create([
                'dealership_id' => $dealerships->random()->id
            ]);
        }

        // Retrieve all users again after shuffling
        $users = \App\Models\User::all()->shuffle();

        // Loop through each user to associate them with random cars
        foreach ($users as $user) {
            // Get a random selection of cars, with a quantity between 0 and 4
            $cars = \App\Models\Car::inRandomOrder()->take(rand(0, 4))->get();

            // Loop through each randomly selected car for the current user
            foreach ($cars as $car) {
                // Create a new CarBiding using a factory, associating it with the current car and user
                \App\Models\CarBiding::factory()->create([
                    'car_id' => $car->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}