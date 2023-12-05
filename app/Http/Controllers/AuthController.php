<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function create()
    {
        // Display the user authentication form.
        return view('auth.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Retrieve user credentials from the request
        $credentials = $request->only('email', 'password');

        // Check if the "Remember Me" checkbox is selected
        $remember = $request->filled('remember');

        // Attempt to authenticate the user using provided credentials
        if (Auth::attempt($credentials, $remember)) {
            // Redirect to the intended URL or the default '/' if not specified
            return redirect()->route('cars.index');
        } else {
            // Redirect back with an error message if authentication fails
            return redirect()->route('auth.create')->withInput()->withErrors(['error' => 'Invalid Credentials']);
        }
    }

    /**
     * Display the registration form.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration form submission.
     */
    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user with the given email already exists
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // User already exists, display a message and redirect to registration form
            return redirect()->route('auth.register')->withErrors(['error' => 'User with this email already registered']);
        }

        // User does not exist, proceed with registration
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('cars.index')->with('success', 'Registration successful');
    }

    /**
     * Log the user out.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('cars.index');
    }
}