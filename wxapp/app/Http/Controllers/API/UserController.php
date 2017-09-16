<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    //用户登陆
    public function login(Request $request){
        $name = $request->input("name");
        $pass = $request->input("pass");
        $data = DB::table('user')->where('name',$name)->first();
        //如果存在此用户
        if($data){
            // $data = get_object_vars($data);  //将对象转化为数组
            if($pass == $data['md5_pass']){ //如果密码正确
                // if($data['token'] != 0){ //如果用户已经登陆
                //  return  response()->json([
                //          'code' => '404',
                //          'message' => '该用户已经登陆',
                //          'data' => ""
                //      ]);
                // }
                $token = md5($name.time());     //生成即使token
                //如果用户未登陆，写入token
                $time = date("Y-m-d H:i:s",time());
                DB::table('user')->where('name',$name)->update(["token"=>$token,"login_time"=>$time]);
                return response()->json([
                        'code' => '200',
                        'message' => '登陆成功',
                        'data' => ['token'=>$token,'name'=>$name]
                    ]);
            }else{
                return  response()->json([
                        'code' => '404',
                        'message' => '密码错误',
                        'data' => ""
                    ]);
            }
        }else{
            return  response()->json([
                        'code' => '404',
                        'message' => '用户不存在',
                        'data' => ""
                    ]);
        }
    }

    public function logout(Request $request){
        $name = $request->input("name");
        $flag = DB::update("update user set token='0' where name='$name'");
        if($flag){
            return  response()->json([
                        'code' => '200',
                        'message' => '登出成功',
                        'data' => ""
                    ]);
        }
    }
}
