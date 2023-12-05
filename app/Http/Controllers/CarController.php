<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of all cars available.
     */
    public function index()
    {
        if (auth()->check()) {
            $this->authorize('viewAny', Car::class);
        }
        
        // Start with a query builder for the Car model
        $cars = Car::query();
    
        // Get values of specific request parameters
        $filters = request()->only([
            'search',
            'min_price',
            'max_price',
            'bodyType',
            'state'
        ]);
    
        // Retrieve the filtered cars and pass them to the view
        return view(
            'car.index', 
            [
                'cars' => Car::with('dealership')->latest()->filter($filters)->get()
            ]
        );
    }
    
    /**
     * Display the details of a specific car.
     */
    public function show(Car $car)
    {
        if (auth()->check()) {
            $this->authorize('viewAny', Car::class);
        }
        
        return view('car.show', [
            'car' => $car->load('dealership'),
            'dealershipCars' => $car->dealership->cars
        ]);
    }
}