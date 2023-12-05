<x-card class="mb-4">
  <div class="mb-4 flex justify-between">
    <div class="flex items-center space-x-4">
      <h2 class="text-lg font-medium">{{ $car->make }}</h2>
      @if ($car->deleted_at)
      <span class="text-xs text-red-500">Deleted</span>
      @endif
    </div>
  
    <div class="text-slate-500">
      £{{ number_format($car->price) }}
    </div>
  </div>

  <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
    <div class="flex space-x-4">
      <div>Dealership:</div>
      <div>{{ $car->dealership->dealership_name }}</div>
    </div>
    <div class="flex space-x-1 text-xs">
      <x-label><a href = {{route('cars.index', ['bodyType' => $car->bodyType])}}>    {{ $car->bodyType }}</a></x-label>
      <x-label><a href = {{route('cars.index', ['state' => $car->state])}}>    {{ $car->state }}</a></x-label>

  </div>
  </div>


  {{ $slot }}
</x-card>