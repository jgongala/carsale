<?php

namespace App\Http\Controllers;

use App\Models\CarBiding;
use App\Models\User;
use Illuminate\Http\Request;

class MyBidApplicationController extends Controller
{
    /**
     * Display a listing of the user's car bid applications.
     */
    public function index()
    {    
        // $car = auth()->user()->carBiding();
        // dd($car->first());
        // Retrieve and display the user's car bid applications
        return view(
            'my_car_bid.index',
            [
                'bids' => auth()->user()->carBiding()
                    ->with([
                        'car' => fn($query) => $query->withCount('carBiding')
                            ->withAvg('carBiding', 'expected_price')
                            ->withTrashed(),
                        'car.dealership'
                    ])
                    ->latest()->get()
            ]
        );
    }
    
    /**
     * Remove the specified car bid application from storage.
     */
    public function destroy($myCarId)
    {
        $myCar = CarBiding::find($myCarId);

        if (!$myCar) {
            // Handle case where the model does not exist
            return redirect()->back()->with('error', 'Car Bid application not found.');
        }

        // Now proceed with deletion
        $myCar->delete();
        
        // Redirect back with a success message
        return redirect()->back()->with(
            'success',
            'Car Bid application removed.'
        );
    }
}