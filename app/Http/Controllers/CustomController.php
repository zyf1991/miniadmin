<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;
use App\Libs\Wx\WXBizDataCrypt;
class CustomController extends Controller
{

    public function index(Request $request)
    {


        $request_data = $request->all();
        //dd($request_data);
        if(!$request_data['openid'] || !$request_data['session_key'] || !isset($request_data['api_token']) || $request_data['api_token']!=config("app.api_token")) return response()->json(showMsg(201,'tokens error'), 201);


        $where = [
            'session_key'=>$request_data['session_key'],
            'openid'=>$request_data['openid']
        ];
        $Plan = Custom::where($where)->first();
        //dd($Plan->toArray());
        if(!$Plan) return response()->json(showMsg(201,'没有用户信息'));
        return response()->json(showMsg(200,'success',$Plan->toArray()));


    }
    //
    public function store(Request $request_data)
    {
        if(!isset($request_data['api_token']) || $request_data['api_token']!=config("app.api_token")) return response()->json(showMsg(201,'token error'), 201);
        if(!$request_data['code'])  return response()->json(showMsg(202,'error'));

        $input = $request_data->all();
        $code = $input['code'];
        $openInfo = getUserOpenIdBycode($code);


        $input['openid']=$openInfo['openid'];
        $input['session_key']=$openInfo['session_key'];
        $input['wxname']=$input['wxname']?$input['wxname']:'test';

        //dd($input);
        $Plan = Custom::create($input);
        if(!$Plan){
            return response()->json(showMsg(201,'error'));
        }

        $success=['id'=>$Plan->id];
        return response()->json(showMsg(200,'success',$success));
    }
}
