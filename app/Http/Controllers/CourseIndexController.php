<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
class CourseIndexController extends Controller
{
    //
    public function show(Request $request)
    {
        $request_data=$request->all();
        if(!isset($request_data['id']) || !isset($request_data['api_token']) || $request_data['api_token']!=config("app.api_token")) return response()->json(showMsg(201,'token error'), 201);


        $Course = Course::where('id',$request_data['id'])->first('c_video');
        return response()->json(showMsg('200','success',$Course->toArray()));
    }

    public function free(Request $request)
    {
        $request_data=$request->all();
        if(!isset($request_data['api_token']) || $request_data['api_token']!=config("app.api_token")) return response()->json(showMsg(201,'token error'), 201);

        $where=['saletype'=>0,'showpostion'=>1];
        $Course = Course::where($where)->get();
        $return =['free1'=>$Course->toArray(),
            'free2'=>$this->free2(),
            ];
        return response()->json(showMsg('200','success',$return));
    }

    public function free2()
    {


        $Course = Course::where('saletype','0')->where('showpostion','>',1)->get();
        return $Course->toArray();
    }
}
