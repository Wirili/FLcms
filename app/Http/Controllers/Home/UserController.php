<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use Validator;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function child_list()
    {
        $child_list=\Auth::user()->children()->paginate(12);;
        return view('home.child_list',[
            'child_list'=>$child_list
        ]);
    }
    public function act_user(Request $request)
    {
        if($request->isMethod('POST')){
            $validator = Validator::make($request->all(), [
                'act_user'=>'required|size:10'
            ], [
                'act_user.required'=>'请输入要激活的玩家编号！',
                'act_user.size'=>'玩家编号长度不够！'
            ]);
            $validator->after(function($validator) {
                if (floatval($this->config['user_act_point1'])>\Auth::user()->point1) {
                    $validator->errors()->add('user_act_point1', '激活币不足，请联系客服进行充值！');
                }
            });
            if($validator->fails()){
                if($request->expectsJson()){
                    return new JsonResponse($validator->errors()->getMessages(),422);
                }
            }
        }else
            return view('home.act_user');
    }
}
