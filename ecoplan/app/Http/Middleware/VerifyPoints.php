<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyPoints
{
    public function handle(Request $request, Closure $next, $points)
    {
        if (auth()->user()->points < $points) {
            return redirect()->back()->with('error', 'Insufficient points for this action');
        }

        return $next($request);
    }
}
