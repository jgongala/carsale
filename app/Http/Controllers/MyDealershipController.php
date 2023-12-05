<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class MyDealershipController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated before authorizing,
        // and authorize only authenticated users.
        if (auth()->check()) {
            $this->authorize('viewAnyDealership', Car::class);
        }
    
        return view('my_cars.index', [
            'cars' => auth()->user()->dealership
                ->cars()
                ->with('dealership', 'carBiding', 'carBiding.user') 
                ->withTrashed()
                ->get()
        ]);
    }
    
    public function create()
    {
        $this->authorize('create', Car::class);
        return view('my_cars.create');
    }

    public function store(CarRequest $request)
    {
        $this->authorize('create', Car::class);
        auth()->user()->dealership->cars()->create($request->validated());
        return redirect()->route('my-cars.index')
            ->with('success', 'Car offer created successfully.');
    }

    public function edit(Car $myCar)
    {
        $this->authorize('update', $myCar);
        return view('my_cars.edit', ['car' => $myCar]);
    }

    public function update(CarRequest $request, Car $myCar)
    {
        $this->authorize('update', $myCar);
        $myCar->update($request->validated());

        return redirect()->route('my-cars.index')
            ->with('success', 'Car Offer updated successfully.');
    }

    public function destroy(Car $myCar)
    {
        //
        $myCar->delete();

        return redirect()->route('my-cars.index')
            ->with('success', 'Car offer deleted.');
    }

}