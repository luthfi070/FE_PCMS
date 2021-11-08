<?php

namespace App\Http\Middleware;

use Closure;

class VerifyProject
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
        if(session('ProjectID') == null){
            return redirect()->route('project');
        }
        return $next($request);
    }
}
