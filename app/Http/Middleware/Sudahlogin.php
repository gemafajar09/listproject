<?php

namespace App\Http\Middleware;

use Closure;

class Sudahlogin
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
        if(session('id_admin') == null) {
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}
