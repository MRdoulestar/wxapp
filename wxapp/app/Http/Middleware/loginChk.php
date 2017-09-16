<?php

namespace App\Http\Middleware;

use Closure;

class loginChk
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
        //验证是否已经登陆
        if(!empty(session('id'))){
            return $next($request);    
        }else{
            // return back();   //会有登出后的重定向过多问题
            return redirect(route("loginweb")); //解决重定向过多
        }
    }
}
