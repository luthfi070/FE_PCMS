<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAuth
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
        if(session('UserID') == null){
            return redirect()->route('index');
        }
        return $next($request);
    }
}
