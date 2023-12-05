<?php

namespace App\Models;

use App\Models\CarBiding;
use App\Models\Dealership;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'make',
        'model',
        'price',
        'mileage',
        'registration',
        'location',
        'year',
        'bodyType',
        'state'
    ];

    public static array $bodyType = ['Convertible', 'SUV', 'Coupe', 'Estate', 'Hatchback'];
    public static array $make = ['Ford', 'Audi', 'BMW', 'Nissan', 'Toyota'];
    public static array $state = ['New', 'Used'];

    public function dealership(): BelongsTo { // Correct return type
        return $this->belongsTo(Dealership::class);
    }

    public function carBiding(): HasMany
    {
        return $this->hasMany(CarBiding::class);
    }
    public function hasUserBid(Authenticatable|User|int $user): bool {
        return $this->where('id', $this->id)
            ->whereHas(
                'carBiding',
                fn($query) => $query->where('user_id', '=', $user->id ?? $user)
            )->exists();
    }

    public function scopeFilter(Builder | QueryBuilder $query, array $filters): Builder | QueryBuilder 
    {
        // Apply search filter if 'search' parameter is present
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('make', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhereHas('dealership', function ($query) use ($search) {
                        $query->where('dealership_name', 'like', '%' . $search . '%');
                    });
            });
        })

        // Apply min_price filter if 'min_price' parameter is present
        ->when($filters['min_price'] ?? null, function ($query, $minPrice) {
            $query->where('price', '>=', $minPrice);
        })

        // Apply max_price filter if 'max_price' parameter is present
        ->when($filters['max_price'] ?? null, function ($query, $maxPrice) {
            $query->where('price', '<=', $maxPrice);
        })

        // Apply bodyType filter if 'bodyType' parameter is present
        ->when($filters['bodyType'] ?? null, function ($query, $bodyType) {
            $query->where('bodyType', $bodyType);
        })

        // Apply model filter if 'state' parameter is present
        ->when($filters['state'] ?? null, function ($query, $state) {
            $query->where('state', $state);
        });
    }
}