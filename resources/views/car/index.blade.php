<x-layout>
    
    <!-- Navbar -->
    <x-navbar class="mb-3" :links="['Cars' => route('cars.index')]"></x-navbar>

    <!-- Search and Price Filters -->
    <x-card class="mb-3 text-sm"  x-data="">
        <form x-ref="filters" id="filtering-form"  action="{{ route('cars.index') }}" method="GET">
            <div class="mb-3 grid grid-cols-2 gap-3">

                <!-- Search Filter -->
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for any text" form-ref="filters"/>
                </div>

                <!-- Price Range Filter -->
                <div>
                    <div class="mb-1 font-semibold">Price</div>

                    <!-- Price Input Fields -->
                    <div class="flex space-x-1.5">
                        <x-text-input name="min_price" value="{{ request('min_price') }}" placeholder="From" form-ref="filters"/>
                        <x-text-input name="max_price" value="{{ request('max_price') }}" placeholder="To"  form-ref="filters"/>
                    </div>
                </div>

                <!-- Body Type Filter -->
                <div>
                    <!-- Label for the body type radio buttons -->
                    <div class = "mb-1 font-semibold">Body Type</div>

                    <x-radio-group name="bodyType" :options="\App\Models\Car::$bodyType" />

                </div>
                <!-- Brand Filter Filter -->
                <div>
                    <!-- Label for the brand type radio buttons -->
                    <div class = "mb-1 font-semibold">State</div>

                    <x-radio-group name="state" :options="\App\Models\Car::$state" />

                </div>
            </div>

            <x-button class="w-full">Filter</x-button>
        </form>


    </x-card>

    <!-- Display Cars -->
    @foreach ($cars as $car)
        <!-- Individual Car Card -->
        <x-car-cart class="mb-3 items-center" :car="$car">
            <div>
                <!-- "See More" Button linking to Car Details -->
                <x-link-btn :href="route('cars.show', ['car' => $car])">
                    See More
                </x-link-btn>
            </div>
        </x-car-cart>
    @endforeach

</x-layout>
