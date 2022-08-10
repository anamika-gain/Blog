<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApproved
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->approved_at) {
            return redirect()->route('approval');
        }

        return $next($request);
    }
}
