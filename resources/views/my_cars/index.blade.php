<x-layout>
  <x-navbar :links="['My Cars' => route('my-cars.index')]" class="mb-4" />
  
  <div class="mb-8 text-right">
    <x-link-btn href="{{ 'my-cars/create' }}">Add New Car</x-link-btn>
  </div>
  
  @forelse ($cars as $car)
    <x-car-cart :car="$car">
      <div class="text-sm text-slate-400">
        @forelse ($car->carBiding as $biding)
            <div class="mb-4 flex items-center justify-between">
              <div>{{ $biding->user->name }}</div>
              <div>
                Bidded {{ $biding->created_at->diffForHumans() }}
              </div>
              <div>${{ number_format($biding->expected_price) }}</div>
            </div>
        @empty
            <div>No Car offers yet</div>
        @endforelse 

      </div>

      <div class="flex space-x-2 mt-5">
        <x-link-btn href="{{ route('my-cars.edit', $car) }}">Edit</x-link-btn>
        <form action="{{ route('my-cars.destroy', $car) }}" method="POST">
          @csrf
          @method('DELETE')
          <x-button class="border-slate-400 font-light">Delete</x-button>
        </form>

      </div>
    </x-car-cart>

  @empty
    <div class="rounded-md border border-dashed border-slate-300 p-8">
      <div class="text-center font-medium">
        No cars yet
      </div>
      <div class="text-center">
        Post your first car offer <a class="text-indigo-500 hover:underline"
          href="{{ route('my-cars.create') }}">here!</a>
      </div>
    </div>
  @endforelse
  
</x-layout>