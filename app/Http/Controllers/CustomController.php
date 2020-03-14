<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom;

class CustomController extends Controller
{
    //
    public function store(Request $request)
    {


        $request_data = $request->all();
        if(!isset($request_data['api_token']) || $request_data['api_token']!=config("app.api_token")) return response()->json(showMsg(201,'token error'), 201);
        if(!$request_data['code'])  return response()->json(showMsg(202,'error'));

        //获取openid
        $APPID=config("app.AppID");
        $AppSecret=config("app.AppSecret");
        $JSCODE=$request_data['code'];
        $url=config("app.getOpenIdUrl")."appid=".$APPID."&secret=".$AppSecret."&js_code=".$JSCODE."&grant_type=authorization_code";
        $response = curl_response($url);
        if(!$response) return response()->json(showMsg(202,'openid no'));

        $data['openid']=$response['oppenid'];
        $data['wxname']=$data['nickName'];
        $Plan = Custom::create($data);
        if(!$Plan){
            return response()->json(showMsg(201,'error'));
        }


        $success=['c_id'=>$Plan->id,'api_token'=>config("app.api_token")];
        return response()->json(showMsg(200,'success',$success));
    }
}
