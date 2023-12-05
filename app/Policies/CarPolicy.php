<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }
    
    // Allow any user to view a list of cars (index page)
    public function viewAnyDealership(?User $user): bool
    {
        return true;
    }

    // Allow any user to view a single car
    public function view(User $user, Car $car): bool
    {
        return true;
    }

    // Allow creating a new car only if the user is associated with a dealership
    public function create(User $user): bool
    {
        return $user->dealership !== null;
    }

    // Allow updating a car only if the user owns the associated dealership
    // and there are no bids on the car
    public function update(User $user, Car $car): bool|Response
    {
        if ($car->dealership->user_id !== $user->id) {
            return false;
        }

        if ($car->carBiding()->count() > 0) {
            return Response::deny('Cannot change the car offer with applications');
        }

        return true;
    }

    // Allow deleting a car only if the user owns the associated dealership
    public function delete(User $user, Car $car): bool
    {
        return $car->dealership->user_id === $user->id;
    }   
    
    // Allow restoring a soft-deleted car only if the user owns the associated dealership
    public function restore(User $user, Car $car): bool
    {
        return $car->dealership->user_id === $user->id;
    }

    // Allow permanently deleting a car only if the user owns the associated dealership
    public function forceDelete(User $user, Car $car): bool
    {
        return $car->dealership->user_id === $user->id;
    }

    // Allow a user to bid on a car only if they haven't already placed a bid
    public function bid(User $user, Car $car): bool
    {
        return !$car->hasUserBid($user);
    }
}