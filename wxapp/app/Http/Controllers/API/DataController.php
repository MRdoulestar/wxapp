<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class DataController extends Controller
{
    //获取所有未审核item
    public function getItem(){
    	$data = DB::table('appdata')->where('app_statu',0)->get();
    	if(sizeof($data)){
    		return response()->json([
    				'code'=>'200',
    				'message'=>'获取成功',
    				'data'=>$data
    			]);
    	}else{
    		return response()->json([
    				'code'=>'406',
    				'message'=>'没有待审核条目',
    				'data'=>''
    			]);
    	}
		
    }
    //获取指定用户item
    public function getUserItem(Request $request){
    	$name = $request->input('name');
    	$data = DB::table('appdata')->where('chk_by',$name)->get();
    	if(sizeof($data)){
    		return response()->json([
    				'code'=>'200',
    				'message'=>'获取成功',
    				'data'=>$data
    			]);
    	}else{
    		return response()->json([
    				'code'=>'406',
    				'message'=>'没有历史条目',
    				'data'=>''
    			]);
    	}
    }

    //按条件查询为未审核item
    public function searchItem(Request $request){
    	$date = $request->input('appdate');
    	$firm = $request->input('appfirm');
   		$name = $request->input('appname');
   		if(!empty($name)){
   			if(!empty($firm)){
   				if(!empty($date)){
   					$data = DB::table('appdata')->where(['app_name'=>$name,'app_firm'=>$firm,'sub_time'=>$date])->get();
   				}else{$data = DB::table('appdata')->where(['app_name'=>$name,'app_firm'=>$firm])->get();}
   			}else{
   				if(!empty($date)){
   					$data = DB::table('appdata')->where(['app_name'=>$name,'sub_time'=>$date])->get();
   				}else{$data = DB::table('appdata')->where(['app_name'=>$name])->get();}
   			}
   		}else{
   			if(!empty($firm)){
   				if(!empty($date)){
   					$data = DB::table('appdata')->where(['app_firm'=>$firm,'sub_time'=>$date])->get();
   				}else{$data = DB::table('appdata')->where(['app_firm'=>$firm])->get();}
   			}else{
   				if(!empty($date)){
   					$data = DB::table('appdata')->where(['sub_time'=>$date])->get();
   				}else{$data = array();}		//如果无条件 返回空
   			}
   		}
   		return response()->json([
   				'code'=>'200',
   				'message'=>'查询成功',
   				// 'message'=>$date,
   				// 'data'=>["1"=>empty($date),"2"=>empty($name),"3"=>empty($firm)]
   				'data'=>$data
   			]);
    }
    //按条件查询用户的item
	public function searchUserItem(Request $request){
		$date = $request->input('appdate');
		$firm = $request->input('appfirm');
		$appname = $request->input('appname');
		$name = $request->input('name');
		if(!empty($appname)){
			if(!empty($firm)){
				if(!empty($date)){
					$data = DB::table('appdata')->where(['chk_by'=>$name,'app_name'=>$appname,'app_firm'=>$firm,'sub_time'=>$date])->get();
				}else{$data = DB::table('appdata')->where(['chk_by'=>$name,'app_name'=>$appname,'app_firm'=>$firm])->get();}
			}else{
				if(!empty($date)){
					$data = DB::table('appdata')->where(['chk_by'=>$name,'app_name'=>$appname,'sub_time'=>$date])->get();
				}else{$data = DB::table('appdata')->where(['chk_by'=>$name,'app_name'=>$appname])->get();}
			}
		}else{
			if(!empty($firm)){
				if(!empty($date)){
					$data = DB::table('appdata')->where(['chk_by'=>$name,'app_firm'=>$firm,'sub_time'=>$date])->get();
				}else{$data = DB::table('appdata')->where(['chk_by'=>$name,'app_firm'=>$firm])->get();}
			}else{
				if(!empty($date)){
					$data = DB::table('appdata')->where(['chk_by'=>$name,'sub_time'=>$date])->get();
				}else{$data = array();}
			}
		}
		return response()->json([
				'code'=>'200',
				'message'=>'查询成功',
				'data'=>$data
			]);
	}
	//通过审核
	public function passItem(Request $request){
		$id = $request->input('appid');
		$name = $request->input('name');
		$flag = DB::table('appdata')->where('id',$id)->update(['app_statu'=>'1','chk_by'=>$name,'sub_time'=>date("Y-m-d",time())]);
		if($flag){
			return response()->json([
				'code'=>'200',
				'message'=>'操作成功',
				'data'=>''
			]);
		}else{
			return response()->json([
				'code'=>'406',
				'message'=>'操作失败',
				'data'=>''
			]);
		}
	}
	//不通过审核
	public function noPassItem(Request $request){
		$id = $request->input('appid');		//对应小程序的id
		$ext = $request->input('ext');	//备注
		$name = $request->input('name');
		//获得app图片文件路劲
		$app = DB::table('appdata')->where('id',$id)->first();
		$imgurl = $app['app_img_url'].'/';
		//处理数据库内容
		$flag = DB::table('appdata')->where('id',$id)->update(['app_statu'=>'2','chk_by'=>$name,'ext'=>$ext,'sub_time'=>date("Y-m-d",time())]);
		if($flag){
			//处理上传的违禁截图
			$data = $request->file('img');
			$data->move($imgurl,'nopass.png');//文件名过长导致500错误
			return response()->json([
				'code'=>'200',
				'message'=>'操作成功',
				'data'=>''
			]);
		}else{
			return response()->json([
				'code'=>'406',
				'message'=>'操作失败',
				'data'=>''
			]);
		}
	}
}

