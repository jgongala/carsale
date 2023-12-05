<x-layout>
    <x-navbar :links="['My Cars' => route('my-cars.index'), 'Edit Car' => '#']" class="mb-4" />
  
    <x-card class="mb-8">
      <form action="{{ route('my-cars.update', $car) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="mb-4 grid grid-cols-2 gap-4">
          <div>
            <label for="make" :required="true">Car Brand</label>
            <x-text-input name="make" :value="$car->make"/>
          </div>

          <div>
            <label for="model" :required="true">Car Model</label>
            <x-text-input name="model" :value="$car->model" />
          </div>

          <div class="col-span-2">
            <label for="price" :required="true">Price</label>
            <x-text-input name="price" type="number" :value="$car->price" />
          </div>
  
          <div class="col-span-2">
            <label for="location" :required="true">Location</label>
            <x-text-input name="location" :value="$car->location" />
          </div>
  
          <div class="col-span-2">
            <label for="year" :required="true">Year</label>
            <x-text-input name="year" type="number" :value="$car->year" />
          </div>
  
          <div class="col-span-2">
            <label for="mileage" :required="true">Mileage</label>
            <x-text-input name="mileage" :value="$car->mileage" />
          </div>

          <div class="col-span-2">
            <label for="registration" :required="true">Registration</label>
            <x-text-input name="registration" :value="$car->registration" />
          </div>
  
          <div>
            <label for="bodyType" :required="true">Body Type</label>
            <x-radio-group name="bodyType" :value="$car->bodyType"
              :all-option="false"
              :options="array_combine(
                  array_map('ucfirst', \App\Models\Car::$bodyType),
                  \App\Models\Car::$bodyType,
              )" />
          </div>
  
          <div>
            <label for="state" :required="true">State</label>
            <x-radio-group name="state" :all-option="false" :value="$car->state"
              :options="\App\Models\Car::$state" />
          </div>
  
          <div class="col-span-2">
            <x-button class="w-full">Save</x-button>
          </div>
        </div>
      </form>
    </x-card>
  </x-layout>