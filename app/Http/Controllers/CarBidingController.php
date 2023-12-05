<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBiding;
use Illuminate\Http\Request;

class CarBidingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Car $car)
    {
        // Authorize the user to bid on the specified car
        $this->authorize('bid', $car);

        // Display the car bidding creation form with the specified car
        return view('car_biding.create', ['car' => $car]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Car $car, Request $request)
    {
        // Validate the request data before storing it
        $request->validate([
            'expected_price' => 'required|min:1|max:1000000'
        ]);

        // Authorize the user to bid on the specified car
        $this->authorize('bid', $car);

        // Create a new car bidding for the specified car
        $carBiding = new CarBiding([
            'user_id' => $request->user()->id,
            'expected_price' => $request->input('expected_price')
        ]);

        // Save the car bidding for the specified car
        $car->carBiding()->save($carBiding);

        // Redirect to the car show page with a success message
        return redirect()->route('cars.show', $car)
            ->with('success', 'Car Bid application submitted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method could be implemented to handle the deletion of a car bidding,
        // but it's currently empty. Consider adding logic to delete a specific bidding.
    }
}