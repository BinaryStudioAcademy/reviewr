<?php

namespace App\Http\Middleware;

use Closure;

class BinaryAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->cookie('x-access-token')) {
            return redirect('/');
        }
        return $next($request);
    }
}
