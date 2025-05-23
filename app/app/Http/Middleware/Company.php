<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Company
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
        if ( Auth::check() && Auth::user()->roles[0]->id == 5)
        {
            return $next($request);
        }

        return redirect('login');
    }
}
