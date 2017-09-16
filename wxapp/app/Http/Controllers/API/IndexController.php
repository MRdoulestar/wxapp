<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //api欢迎界面
    public function index(){
		return response()->json([
            'code' => '400',
            'message' => '无权使用api',
            'data' => '',
        ]);
    }
}

