<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_MemoryDrawing;
use PHPExcel_Cell;
use PHPExcel_IOFactory;
// include "../app/Lib/PHPExcel/Worksheet/Drawing.php";
// include "../app/Lib/PHPExcel/Worksheet/MemoryDrawing.php";
class ExcelController extends Controller
{
    //导出excel数据
    public function export(){
	    //Excel文件导出功能 
	    $cellData = DB::table("appdata")->where('app_statu','!=',0)->select('app_name','app_firm','app_time','app_statu','app_img_url','sub_time','chk_by','ext')->get();
        Excel::create('审核结果',function($excel) use ($cellData){
            $excel->sheet('data', function($sheet) use ($cellData){
                $sheet->rows($cellData);
                $sheet->setWidth('i', 20);	//设置单元格宽度
                $sheet->setWidth('j', 20);	//设置单元格宽度
                $sheet->setWidth('k', 20);	//设置单元格宽度
                $sheet->setWidth('l', 20);	//设置单元格宽度
                foreach ($cellData as $key => $value) {
                	$sheet->setHeight($key+1, 50);	//设置单元格高度
                	
                	$objDrawing = new PHPExcel_Worksheet_Drawing;
		            // $objDrawing->setPath(public_path('/img/test.png')); //your image path
		            $objDrawing->setPath($value['app_img_url'].'/1.png'); //your image path
		            $objDrawing->setHeight(60);
		            $objDrawing->setCoordinates('I'.($key+1));
		            //设置单元格格式	
		            $objDrawing->setRotation(20);
		            $objDrawing->getShadow()->setVisible(true);
					$objDrawing->getShadow()->setDirection(50);
		            $objDrawing->setWorksheet($sheet);

		            $objDrawing = new PHPExcel_Worksheet_Drawing;
		            // $objDrawing->setPath(public_path('/img/test.png')); //your image path
		            $objDrawing->setPath($value['app_img_url'].'/2.png'); //your image path
		            $objDrawing->setHeight(60);
		            $objDrawing->setCoordinates('J'.($key+1));
		            //设置单元格格式	
		            $objDrawing->setRotation(20);
		            $objDrawing->getShadow()->setVisible(true);
					$objDrawing->getShadow()->setDirection(50);
		            $objDrawing->setWorksheet($sheet);

		            $objDrawing = new PHPExcel_Worksheet_Drawing;
		            // $objDrawing->setPath(public_path('/img/test.png')); //your image path
		            $objDrawing->setPath($value['app_img_url'].'/3.png'); //your image path
		            $objDrawing->setHeight(60);
		            $objDrawing->setCoordinates('K'.($key+1));
		            //设置单元格格式	
		            $objDrawing->setRotation(20);
		            $objDrawing->getShadow()->setVisible(true);
					$objDrawing->getShadow()->setDirection(50);
		            $objDrawing->setWorksheet($sheet);
		            if($value['app_statu'] == 2){
	                	$objDrawing = new PHPExcel_Worksheet_Drawing;
			            // $objDrawing->setPath(public_path('/img/test.png')); //your image path
			            $objDrawing->setPath($value['app_img_url'].'/nopass.png'); //your image path
			            $objDrawing->setHeight(60);
			            $objDrawing->setCoordinates('L'.($key+1));
			            //设置单元格格式
	
			            $objDrawing->setRotation(20);
			            $objDrawing->getShadow()->setVisible(true);
						$objDrawing->getShadow()->setDirection(50);
			            $objDrawing->setWorksheet($sheet);
		            }
                }
            });
        })->export('xls');
    }

    //导入excel数据
    public function import(Request $request){
    	//保存上传的excel
    	if($request->hasFile('excel')){
	    	$file = $request->file('excel');
	    	$file->move('./excel/','import.xls');
	    	//Excel文件导入功能 
		    $filePath = './excel/'.iconv('UTF-8', 'GBK', 'import').'.xls';
		    Excel::load($filePath, function($reader) {
		    	$reader->formatDates(true, 'Y-m-d');	//设置读取日期格式
		        $sheet=$reader->getSheet(0);//选择第几个表，如下面图片，默认有三个表
		        $data=$sheet->toArray();//把表格的数据转换为数组，注意：这里转换是以行号为数组的外层下标，列号会转成数字为数组内层下标
		        // dd($data);
		        //信息数据处理
		        $index = array();	//文件名索引
		        $sub_time = date("Y-m-d",time());	//设置提交审核日期
		        foreach ($data as $key => $value) {
		        	$time = $value[2];
		        	$path = md5($value[0].$value[1]);
		        	$index[] = $path;
		        	$data= array("app_name"=>$value[0],"app_firm"=>$value[1],"app_time"=>$time,"app_img_url"=>'./img/'.$path,"sub_time"=>$sub_time);
		        	DB::table("appdata")->insert($data);
		        }
		        // dd($index);

		        //图片数据处理
		        $FilePath='./img/';//图片保存目录
		        foreach($sheet->getDrawingCollection() as $img){
		        	if($img instanceof PHPExcel_Worksheet_MemoryDrawing){
		        		$pos = PHPExcel_Cell::coordinateFromString($img->getCoordinates());//获取列与行号
		        		$imageFilePath = $FilePath.$index[$pos[1]-1];	//获取对应的记录的图片存储文件名
		        		if(!is_dir($imageFilePath)){
		        			mkdir($imageFilePath);
		        		}
					    //表格解析后图片会以资源形式保存在对象中，可以通过getImageResource函数直接获取图片资源然后写入本地文件中
					    if($pos[0] == "D"){
					    	$imageFileName='1.png';
					    }else if($pos[0] == "E"){
					    	$imageFileName='2.png';
					    }else if($pos[0] == "F"){
					    	$imageFileName='3.png';
					    }
			            
			            imagepng($img->getImageResource(),$imageFilePath.'/'.$imageFileName);
					}
				}
		    });

		    //导入完成
		    return back()->withInput()->with("msg","导入成功");
    	}else
			return redirect("commitweb");
    }

}

