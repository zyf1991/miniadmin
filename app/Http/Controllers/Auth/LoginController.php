<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //


    public function login(Request $request)
    {
//        $request_data = $request->all();
//        //dd($request_data);
//        if(!$request_data['code']) {
//            return response()->json(showMsg(200,'error'));
//        }
//
//        $APPID=config("app.AppID");
//        $AppSecret=config("app.AppSecret");
//        $JSCODE=$request_data['code'];
//        $url="https://api.weixin.qq.com/sns/jscode2session?appid=".$APPID."&secret=".$AppSecret."&js_code=".$JSCODE."&grant_type=authorization_code";
//        dd($url);
        $url="https://api.weixin.qq.com/sns/jscode2session?appid=wxaa1f6a515f14f51e&secret=5c383354b40d20ef18578c6c2390f687&js_code=001tXmgH1W6Lf306y1fH1iRigH1tXmg1&grant_type=authorization_code";
        $response = curl_response($url);

        return $response;

//        $this->validateLogin($request);
//
//        if ($this->attemptLogin($request)) {
//            $user = $this->guard()->user();
//            $user->generateToken();
//
//            return response()->json([
//                'data' => $user->toArray(),
//            ]);
//        }
//
//        return $this->sendFailedLoginResponse($request);
    }

    function validateLogin($request)
    {
        return true;
    }
}
