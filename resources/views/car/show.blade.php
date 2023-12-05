<x-layout>
    <!-- Navigation Bar -->
    <x-navbar class="mb-3" :links="['Cars' => route('cars.index'), $car->dealership->dealership_name => '#']"></x-navbar>

    <!-- Car Details Section -->
    <x-car-cart :car="$car">
        <p class="mb-4 text-sm text-slate-500">
            <!-- Car Details -->
            Model: {{$car->model}}
            <br>
            Location: {{$car->location}}
            <br>
            Year: {{$car->year}}
            <br>
            Mileage: {{$car->mileage}}
            <br>
            Registration: {{$car->registration}}
            
            <!-- Bid Section -->
            @auth
                @can('bid', $car)
                    <!-- User is authenticated and can bid -->
                    <x-link-btn :href="route('car.biding.create', $car)">
                        Bid
                    </x-link-btn>
                @else
                    <!-- User has already bid on this car -->
                    <div class="text-center text-sm font-medium text-slate-500">
                        You already bid on this car
                    </div>
                @endcan
            @else
                <!-- User is not authenticated -->
                <div class="text-center text-sm font-medium text-slate-500">
                    <x-link-btn :href="route('auth.create', $car)">
                        Sign in to bid on this car
                    </x-link-btn>
                </div>
            @endauth
        </p>
    </x-car-car>

    <!-- Related Cars Section -->
    <x-card class="mb-3">
        <h2 class="mb-3 text-lg font-small"> More {{$car->dealership->dealership_name}} Cars</h2>
        <div class="text-sm text-slate-400">
            <!-- Displaying other cars from the same dealership -->
            @foreach ( $car->dealership->cars as $otherCars)
                <div class="mb-3 flex justify-between">
                    <div>
                        <!-- Car Information and Link to Details -->
                        <div class="text-slate-700">
                            <a href="{{ route('cars.show', $otherCars) }}">
                                {{ $otherCars->make }} {{ $otherCars->model }}
                            </a>
                        </div>
                        <!-- Car Creation Date -->
                        <div class="text-xs">
                            {{ $otherCars->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <!-- Car Price -->
                    <div class="text-xs">
                        ${{ number_format($otherCars->price) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
