<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BuilderMiddleware
{
    // Handle an incoming request to any of the Builder routes.
    // Used for validation of steps, e.g. can't go to step 3 without having completed step 2.
    public function handle(Request $request, Closure $next)
    {
        // Get the current step (route name).
        $routeName = $request->route()->getName();

        // Steps 2 and 3 require name, from the 1st step.
        if(in_array($routeName, [
            'builder.step2',
            'builder.step2Post',
            'builder.step3',
            'builder.step3Post',
            'builder.finish',
        ])) {
            if (!$request->session()->has('builder.name')) {
                return to_route('builder.step1');
            }
        }

        // Step 3 requires type, from the 2nd step.
        if(in_array($routeName, [
            'builder.step3',
            'builder.step3Post',
            'builder.finish',
        ])) {
            if (!$request->session()->has('builder.type')) {
                return to_route('builder.step2');
            }
        };

        // Finish requires a website to be created, and it's ID to be set in session, from the 3rd step.
        if(in_array($routeName, [
            'builder.finish',
        ])) {
            if (!$request->session()->has('builder.id')) {
                return to_route('builder.step3');
            }
        }

        return $next($request);
    }
}
