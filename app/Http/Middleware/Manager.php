<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Manager
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
        if (Auth::user()->checkRole("interviewer_manager"))
        {
            return $next($request);
        }

        return redirect('login');
    }
}
