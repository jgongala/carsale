<x-layout>
    <!-- Navigation Bar -->
    <x-navbar class="mb-3" :links="['My Car Bid Applications' => '#']"/>

    <!-- Displaying User's Car Bid Applications -->
    @forelse ($bids as $bid)
        <x-car-cart :car="$bid->car">
            <!-- Details of the Car Bid Application -->
            <div class="flex items-center justify-between text-xs text-slate-400">
                <div>
                    <!-- Bid Submission Time -->
                    <div>
                        Bidded {{ $bid->created_at->diffForHumans() }}
                    </div>
                    <!-- Expected Price Offered by the User -->
                    <div>
                        Your offer is: £{{ number_format($bid->expected_price) }}
                    </div>
                </div>
                <!-- Cancel Bid Form -->
                <form action="{{ route('my-car-bid.destroy', $bid) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Cancel</x-button>
                </form>
            </div>
        </x-car-cart>
    @empty
        <!-- No Car Bid Applications Message -->
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No Car bid application yet
            </div>
            <div class="text-center">
                Go find some cars <a class="text-indigo-500 hover:underline"
                    href="{{ route('cars.index') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
