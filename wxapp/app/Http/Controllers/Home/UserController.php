<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    //已经登陆则不显示登陆界面
    public function loginWeb(){
    	if(session('id')){
    		return redirect("index");
    	}
    	return view("Home.login");
    }
    //登陆验证
    public function login(Request $request){
    	$name = $request->input("name");
    	$pass = $request->input("pass");
    	$request->flash();
    	$data = DB::table('admin')->where('name',$name)->first();
    	//如果存在此用户
    	if($data){
    		// $data = get_object_vars($data);	//将对象转化为数组
    		if($pass == $data['md5_pass']){	//如果密码正确
    			//存入session
                $time = date("Y-m-d H:i:s",time());
                DB::table('admin')->where('name',$name)->update(['login_time'=>$time]); //更新用户登陆时间,注意PST
    			session(['id'=>$data['id'],'name'=>$name,'level'=>$data['level']]);
    			return redirect("/index");
    		}else{
				//密码错误
    			return back()->with('msg',"密码错误");
    		}
    	}else{
    		//用户不存在
    			return back()->with('msg',"用户不存在");
    	}
    }

    //退出登陆
    public function logout(Request $request){
    	//清空session
    	session()->flush();
    	return view('Home.login');
    }

    //添加人员
    public function adduser(Request $request){
    	$request->flash();
    	$name = $request->input("name");
    	$pass = $request->input("pass");
    	$level = $request->input("level");
    	$repass = $request->input("repass");

    	if(!empty($name) && !empty($pass) && !empty($repass && !empty($level))){
    		if($pass == $repass){
    			$flag = DB::table("alluser")->where('name',$name)->first();
    			if(!$flag){
    				//通过验证
    				if($level == 3){	//审核员
    					$a=DB::table("user")->insert(["name"=>$name,"pass"=>$pass,"md5_pass"=>md5($pass),"level"=>$level]);
    					$b=DB::table("alluser")->insert(["name"=>$name,"pass"=>$pass,"level"=>$level]);
    					if($a && $b){
                            return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'添加成功']);
                        }else return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'添加失败']);
    				}else{		//管理员和上传员
    					$a=DB::table("admin")->insert(["name"=>$name,"pass"=>$pass,"md5_pass"=>md5($pass),"level"=>$level]);
    					$b=DB::table("alluser")->insert(["name"=>$name,"pass"=>$pass,"level"=>$level]);
    					if($a && $b){
                            return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'添加成功']);
                        }else return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'添加失败']);
    				}
    			}else 	return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'同名人员已存在']);
    		}else	return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'两次密码不一致']);
    	}else{
    		return view("Home.adduser")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','msg'=>'请填写完整']);
    	}
    }

    //获取所有人员信息
    public function getuser(){
    	$data = DB::table('alluser')->orderby('level')->paginate(10);
    	return view("Home.userweb")->with(['num'=>'','nonum'=>'','yesnum'=>'','nochknum'=>'','data'=>$data]);
    }

    //删除人员(ajax)
    public function deluser(Request $request){
    	$name = $request->input('name');
    	$level = $request->input('level');
    	if($level != 3){
			$a=DB::delete("delete from admin where name='$name'");
			$b=DB::delete("delete from alluser where name='$name'");
			if($a && $b){
				return response()->json([
					'code'=>"200",
					'msg'=>"删除成功!"
					]);
			}else return response()->json([
					'code'=>"405",
					'msg'=>"删除失败!"
					]);
    	}else{
	    	$a=DB::delete("delete from user where name='$name'");
	    	$b=DB::delete("delete from alluser where name='$name'");
	    	if($a && $b){
				return response()->json([
					'code'=>"200",
					'msg'=>"删除成功!"
					]);
			}else return view("Home.userweb")->with('msg',"删除失败!");
    	}
    }
    
}

