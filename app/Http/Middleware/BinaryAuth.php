<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        $cookie = $request->cookie('x-access-token');
        //$cookie = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjU1ZGMxMzM5MTg0NmM2OGExYWQ1NmRhYSIsImVtYWlsIjoiYWRtaW5AYWRtaW4iLCJyb2xlIjoiQURNSU4iLCJpYXQiOjE0NDA2NzM4MDV9.rjYkrSZUnBZ1l_eztXgLen-luSq0dsCbMmWW0onCUvo';
        if (empty($cookie)) {
            return redirect()->route('login.binary');
        }
        $user = UserRepository::getUserByCookie($cookie);
        Auth::login($user, false);
        return $next($request);
    }
}
