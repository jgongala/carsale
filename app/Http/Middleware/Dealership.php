<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class Dealership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and associated with a dealership
        if (null === $request->user() || null === $request->user()->dealership) {
            // Redirect to the dealership registration page with an error message
            return redirect()->route('dealership.create')
                ->with('error', 'You need to register as a dealership first!');
        }

        // Continue processing the request if the user is associated with a dealership
        return $next($request);
    }
}