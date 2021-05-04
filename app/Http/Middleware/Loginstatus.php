<?php

namespace App\Http\Middleware;

use Closure;

class Loginstatus
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
        if(session('id_admin') != null) {
            return $next($request);
        } else {
           return redirect('/');
        }
    }
}
