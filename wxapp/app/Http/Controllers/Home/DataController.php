<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{
    //index首页
    public function index(){
        $num = DB::table("appdata")->count();
        $nonum = DB::table("appdata")->where("app_statu","2")->count();
        $yesnum = DB::table("appdata")->where("app_statu","1")->count();
        $nochknum = $num - $nonum -$yesnum;
        return view("Home.index")->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
    }

    //导出数据界面
    public function dataweb(){
    	$num = DB::table("appdata")->count();
    	$nonum = DB::table("appdata")->where("app_statu","2")->count();
    	$yesnum = DB::table("appdata")->where("app_statu","1")->count();
    	$nochknum = $num - $nonum -$yesnum;
    	return view("Home.dataweb")->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
    }
    //导入数据界面
    public function commitweb(){
    	$num = DB::table("appdata")->count();
    	$nonum = DB::table("appdata")->where("app_statu","2")->count();
    	$yesnum = DB::table("appdata")->where("app_statu","1")->count();
    	$nochknum = $num - $nonum -$yesnum;
    	return view("Home.commitweb")->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
    }

    //显示所有待审核项目
    public function nochkweb(Request $request){
        $request->flash();
    	$num = DB::table("appdata")->count();
    	$nonum = DB::table("appdata")->where("app_statu","2")->count();
    	$yesnum = DB::table("appdata")->where("app_statu","1")->count();
    	$nochknum = $num - $nonum -$yesnum;
    	$search = $request->input("search");
        $date = $request->input("date");
    	if(empty($search)){
            if(empty($date)){
                $data = DB::table("appdata")->where("app_statu","0")->paginate();
                return view("Home.nochkweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }else{
                $data = DB::table("appdata")->where("app_statu","0")->where("sub_time",$date)->paginate();
                return view("Home.nochkweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }
    		
    	}else{
            if(empty($date)){
                $data = DB::table("appdata")->where("app_statu","0")->where(function($query) use($search){
                $query->where("app_name",$search)
                    ->orwhere("app_firm",$search);
                })->paginate();
                return view("Home.nochkweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }else{
                $data = DB::table("appdata")->where("app_statu","0")->where("sub_time",$date)->where(function($query) use($search){
                $query->where("app_name",$search)
                    ->orwhere("app_firm",$search);
                })->paginate();
                return view("Home.nochkweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }
    		
    	}
    }
    //显示所有已审核项目
    public function historyweb(Request $request){
        $request->flash();
    	$num = DB::table("appdata")->count();
    	$nonum = DB::table("appdata")->where("app_statu","2")->count();
    	$yesnum = DB::table("appdata")->where("app_statu","1")->count();
    	$nochknum = $num - $nonum -$yesnum;
    	$search = $request->input("search");
        $date = $request->input("date");
    	if(empty($search)){
            if(empty($date)){
                $data = DB::table("appdata")->where("app_statu",">","0")->paginate();
                return view("Home.historyweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }else{
                $data = DB::table("appdata")->where("app_statu",">","0")->where("sub_time",$date)->paginate();
                return view("Home.historyweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            } 		
    	}else{
            if(empty($date)){
                $data = DB::table("appdata")->where("app_statu",">","0")->where(function($query) use($search){
                $query->where("app_name",$search)
                    ->orwhere("app_firm",$search);
                })->paginate();
                return view("Home.historyweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }else{
                $data = DB::table("appdata")->where("app_statu",">","0")->where("sub_time",$date)->where(function($query) use($search){
                $query->where("app_name",$search)
                    ->orwhere("app_firm",$search);
                })->paginate();
                return view("Home.historyweb")->with('data',$data)->with(['num'=>$num,'nonum'=>$nonum,'yesnum'=>$yesnum,'nochknum'=>$nochknum]);
            }
    		
    	}
    }

    //撤回待审核条目
    public function delitem(Request $request){
    	$appid = $request->input('id');

		$flag=DB::delete("delete from appdata where id=$appid");
		
		if($flag){
			return response()->json([
				'code'=>"200",
				'msg'=>"撤销成功!"
				]);
		}else return response()->json([
				'code'=>"405",
				'msg'=>"撤销失败!"
				]);
    }
}

