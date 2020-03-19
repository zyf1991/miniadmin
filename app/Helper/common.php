<?php
if (!function_exists('get_current_time')) {
    function get_current_time(){
        return time();
    }
}
if (!function_exists('get_current_date')) {
    function get_current_date(){
        return date("Y-m-d H:i:s",get_current_time());
    }
}
if (!function_exists('get_current_day')) {
    function get_current_day(){
        return date("Y-m-d",get_current_time());
    }
}

if (!function_exists('get_current_day_hour_minute')) {
    function get_current_day_hour_minute(){
        return date("YmdHi",get_current_time());
    }
}

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
if(!function_exists("showMsg")) {
    function showMsg($status, $message = '', $data = array())
    {
        $result = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
        return $result;
    }
}
if(!function_exists("curl_response")){
    function curl_response($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output,true);
        return $output;
    }
}
if(!function_exists("getUserOpenIdBycode")){
    function getUserOpenIdBycode($code){
        $APPID=config("app.AppID");
        $AppSecret=config("app.AppSecret");
        $JSCODE=$code;
        $url=config("app.getOpenIdUrl")."appid=".$APPID."&secret=".$AppSecret."&js_code=".$JSCODE."&grant_type=authorization_code";
        $response = curl_response($url);

        return $response;
    }
}


?>
