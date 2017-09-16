<?php

namespace App\Http\Middleware;

use Closure;

class adminChk
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
        if(session('level') == 1){
            return $next($request);
        }
        // return redirect("index");
        return back();
    }
}
