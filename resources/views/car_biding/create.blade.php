<x-layout>
    <!-- Navigation Bar -->
    <x-navbar class="mb-3" :links="[
        'Cars' => route('cars.index'), 
        'Bid' => '#']"/>

    <!-- Car Details Section -->
    <x-car-cart :$car>
        <p class="mb-4 text-sm text-slate-500">
            <!-- Displaying Car Details -->
            Location: {{$car->location}}
            <br>
            Year: {{$car->year}}
            <br>
            Mileage: {{$car->mileage}}
            <br>
            Registration: {{$car->registration}}
        </p>
    </x-car-cart>

    <!-- Car Bid Application Section -->
    <x-card>
        <h2 class="mb-3 text-lg font-small"> Your Car Bid Application</h2>
        <!-- Bid Form -->
        <form action={{route('car.biding.store', $car)}} method="POST">
            @csrf
            <!-- Expected Price Input -->
            <div class="mb-3">
                <label for="expected_price"
                class="mb-3 block text-sm font-medium text-slate-500">Expected Price</label>
                <x-text-input type="number" name="expected_price" />
            </div>

            <!-- Submit Button -->
            <x-button class="w-full">Bid</x-button>
        </form>
    </x-card>
</x-layout>
