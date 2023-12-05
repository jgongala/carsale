<x-layout>

    <form action="{{ route('dealership.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dealership_name" class="mb-1 block text-base font-medium text-slate-500">Dealership Name</label>
            <x-text-input name="dealership_name"></x-text-input>
        </div>
        <x-button class="w-full">Create</x-button>
    </form>

</x-layout>
