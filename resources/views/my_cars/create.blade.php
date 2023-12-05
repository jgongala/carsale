<x-layout>
    <x-navbar :links="['My Cars' => route('my-cars.index'), 'Create' => '#']" class="mb-4" />
  
    <x-card class="mb-8">
      <form action="{{ route('my-cars.store') }}" method="POST">
        @csrf
  
        <div class="mb-4 grid grid-cols-2 gap-4">
          <div>
            <label for="make" :required="true">Car Brand</label>
            <x-text-input name="make" />
            @error('make')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="model" :required="true">Car Model</label>
            <x-text-input name="model" />
            @error('model')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-2">
            <label for="price" :required="true">Price</label>
            <x-text-input name="price" type="number" />
            @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
  
          <div class="col-span-2">
            <label for="location" :required="true">Location</label>
            <x-text-input name="location" />
            @error('location')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
  
          <div class="col-span-2">
            <label for="year" :required="true">Year</label>
            <x-text-input name="year" type="number"/>
            @error('year')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
  
          <div class="col-span-2">
            <label for="mileage" :required="true">Mileage</label>
            <x-text-input name="mileage" />
            @error('mileage')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-2">
            <label for="registration" :required="true">Registration</label>
            <x-text-input name="registration" />
            @error('registration')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
  
          <div>
            <label for="bodyType" :required="true">Body Type</label>
            <x-radio-group name="bodyType" :value="old('bodyType')"
              :all-option="false"
              :options="array_combine(
                  array_map('ucfirst', \App\Models\Car::$bodyType),
                  \App\Models\Car::$bodyType,
              )" />
          </div>
  
          <div>
            <label for="state" :required="true">State</label>
            <x-radio-group name="state" :all-option="false" :value="old('state')"
              :options="\App\Models\Car::$state" />
          </div>
  
          <div class="col-span-2">
            <x-button class="w-full">Post Car</x-button>
          </div>
        </div>
      </form>
    </x-card>
  </x-layout>