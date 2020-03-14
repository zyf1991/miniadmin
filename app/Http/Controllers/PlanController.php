<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        //dd(config("app.sys_day"));
        return Plan::all();
    }

    public function show($id)
    {
        $plan = Plan::find($id);
        $return_data['plan_title'] = $plan['plan_title'];
        $between_time = strtotime($plan['plan_etime'])-strtotime($plan['plan_stime']);
        $day = floor($between_time / (3600*24));
        $return_data['plan_etime'] = $day;
        $success=array(
            'status'=>200,
            'msg'=>'success',
            'data'=>$plan
        );
        return response()->json($success, 201);
    }

    public function store(Request $request)
    {

        $input = $request->all();
        if(!isset($input['api_token']) || $input['api_token']!=config("app.api_token")) return response()->json(showMsg(201,'api_token'));
        //任务没失效 不能加任务
        $plan = Plan::where('isexpired',0)->count();
        if($plan>=3) return response()->json(showMsg(200,'您已经添加3个任务了'));

        $sys_day =config("app.plan_expire_day");
        $sys_etime = date("Y-m-d H:i:s",strtotime("+".$sys_day." day"));
        $input['plan_stime']=get_current_date();
        $input['sys_etime']=$sys_etime;
        $Plan = Plan::create($input);


        return response()->json(showMsg(200,'添加成功'));
    }

    public function update(Request $request, Plan $Plan)
    {
        $Plan->update($request->all());

        return response()->json($Plan, 200);
    }

    public function delete(Plan $Plan)
    {
        $Plan->delete();

        return response()->json(null, 204);
    }
}
