<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Events\Registered;
//https://blog.csdn.net/touxian51552/article/details/88593061
class RegisterController extends Controller
{
    public $successStatus = 200;

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['api_token']=\Str::random(60);
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return response()->json(['success'=>$user->api_token], $this->successStatus);
    }

    protected function guard()
    {
        return Admin::guard();
    }

    public function store($request)
    {

        $user = User::create([
            'name'=>$request['name'],
            'password'=>bcrypt($request['password']),
            'email'=>$request['email'],
            'api_token'=>\Str::random(60),
        ]);

        return response()->json($user, 201);;
    }


}
