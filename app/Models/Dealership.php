<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dealership extends Model
{
    use HasFactory;
    protected $fillable = [
        'dealership_name'
    ];

    // Define a one-to-many relationship with the Car model.
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

// Define a many-to-one relationship with the User model.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}