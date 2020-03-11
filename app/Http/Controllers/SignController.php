<?php

namespace App\Http\Controllers;

use App\Models\Sign;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function index()
    {
        //dd(config("app.sys_day"));
        return Sign::all();
    }

    public function show($id)
    {
//        $Sign = Sign::find($id);
//        $return_data['Sign_title'] = $Sign['Sign_title'];
//        $between_time = strtotime($Sign['Sign_etime'])-strtotime($Sign['Sign_stime']);
//        $day = floor($between_time / (3600*24));
//        $return_data['Sign_etime'] = $day;
//        $success=array(
//            'status'=>200,
//            'msg'=>'success',
//            'data'=>$Sign
//        );
//        return response()->json($success, 201);;
    }

    public function store(Request $request)
    {

        $data=[];
        //dd(json_encode($data));
        $input = $request->all();
        if(!isset($input['api_token']) || $input['api_token']!=config("app.api_token")) return response()->json(showMsg('201','token error',$data));


        $find_sign = Sign::find($input['id']);
        if(!is_null($find_sign)) return response()->json(showMsg('201','今天您已打卡',$data));

        $input['sign_time']=get_current_date();
        $input['is_sign']=1;
        $sign = Sign::create($input);

        return response()->json(showMsg('200','success',$data));
    }

    public function update(Request $request, Sign $Sign)
    {
        $Sign->update($request->all());

        return response()->json($Sign, 200);
    }

    public function delete(Sign $Sign)
    {
        $Sign->delete();

        return response()->json(null, 204);
    }
}
