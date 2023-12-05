<x-layout>
    <!-- Page title -->
    <h1 class="my-8 text-center text-3xl font-medium text-slate-500">Sign in to your account</h1>

    <!-- Card containing the login form -->
    <x-card class="py-8 px-20">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf

            <!-- Email input field -->
            <div class="mb-4">
                <label for="email" class="mb-1 block text-base font-medium text-slate-500">E-mail</label>
                <x-text-input name="email"></x-text-input>
            </div>

            <!-- Password input field -->
            <div class="mb-4">
                <label for="password" class="mb-1 block text-base font-medium text-slate-500">Password</label>
                <x-text-input name="password" type="password"></x-text-input>
            </div>

            <!-- Remember Me and Forget Password section -->
            <div class="mb-5 flex justify-between text-sm font-medium">
                <div>
                    <!-- Remember Me checkbox -->
                    <div class="flex items-center space-x-1">
                        <input type="checkbox" name="remember" class="rounded-sm border border-slate-300">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>

                <!-- Forget Password link -->
                <div><a href="#" class="text-blue-800 hover:underline">Forget Password?</a></div>
            </div>
            
            <!-- Button -->
            <x-button class="w-full">Login</x-button>
            
            <!--New acocunt -->
            <div><a href="{{ route('auth.register' )}}" class="mb-5 text-sm text-blue-800 hover:underline">No account? Sign up here!</a></div>
        </form>
        @if ($errors->any())
        <div class="mb-4">
            <div class="text-red-500">
                {{ $errors->first('error') }}
            </div>
        </div>
        @endif
    </x-card>
</x-layout>