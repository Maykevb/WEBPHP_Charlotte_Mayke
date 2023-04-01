<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackRUser
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check() || Auth::user()->role_id != 3 && Auth::user()->role_id != 4 && Auth::user()->role_id != 5)
        {
            abort(403);
        }
        return $next($request);
    }
}
