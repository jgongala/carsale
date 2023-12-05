<x-layout>
    <!-- Page title -->
    <h1 class="my-8 text-center text-3xl font-medium text-slate-500">Sign up to your account</h1>

    <!-- Card containing the login form -->
    <x-card class="py-8 px-20">
        <form action="{{ route('auth.register') }}" method="POST">
            @csrf
            <!-- Name input field -->
            <div class="mb-4">
                <label for="name" class="mb-1 block text-base font-medium text-slate-500">Name</label>
                <x-text-input name="name"></x-text-input>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email input field -->
            <div class="mb-4">
                <label for="email" class="mb-1 block text-base font-medium text-slate-500">E-mail</label>
                <x-text-input name="email"></x-text-input>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Password input field -->
            <div class="mb-4">
                <label for="password" class="mb-1 block text-base font-medium text-slate-500">Password</label>
                <x-text-input name="password" type="password"></x-text-input>
            </div>

            <!-- Password input field -->
            <div class="mb-4">
                <label for="password" class="mb-1 block text-base font-medium text-slate-500">Confirm Password</label>
                <x-text-input name="password" type="password"></x-text-input>
            </div>
            <!-- Button -->
            <x-button class="w-full">Register</x-button>
            
            <!--New acocunt -->
            <div><a href="{{ route('auth.create' )}}" class="mb-5 text-sm text-blue-800 hover:underline">Already have an account? Sign in here!</a></div>
        </form>
        <!-- Display error message if it exists -->
        @if($errors->any())
        <p class="text-red-500 text-sm mt-1">{{ $errors->first() }}</p>
        @endif


    </x-card>
</x-layout>