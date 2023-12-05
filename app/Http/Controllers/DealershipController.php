<?php

namespace App\Http\Controllers;

use App\Models\Dealership;
use Illuminate\Http\Request;

class DealershipController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Dealership::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dealership.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // Check if the user already has a dealership
        if ($user->dealership !== null) {
            return redirect()->route('cars.index')
                ->with('error', 'You already have a dealership account.');
        }

        // User does not have a dealership, proceed to create one
        $user->dealership()->create(
            $request->validate([
                'dealership_name' => 'required|min:3|unique:dealerships,dealership_name'
            ])
        );

        return redirect()->route('cars.index')
            ->with('success', 'Your dealership account was created!');
    }


}