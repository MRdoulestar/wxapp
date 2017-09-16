<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class tokenChk
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
        $name = $request->input('name');
        $token = $request->input('token');
        $data = DB::table('user')->where('name',$name)->first();
        if($data){
            // $data = get_object_vars($data);
            if($data['token'] == $token && $data['token'] != "0"){
                return $next($request);   
            }else{
                return redirect("api/index");  //应当返回无权使用的json格式数据
            }
        }
        return redirect("api/index");  //应当返回无权使用的json格式数据
    }
}
