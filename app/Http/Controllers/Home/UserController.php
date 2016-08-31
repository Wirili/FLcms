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
                'act_user'=>'required|not_in:'.\Auth::user()->name.'|exists:users,name,name,'.$request->act_user.',is_pass,0',
            ], [
                'act_user.required'=>'请输入要激活的玩家编号！',
                'act_user.not_in'=>'不能激活自己的玩家编号！',
                'act_user.exists'=>'激活的玩家编号不存在或已激活！',
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
            \Auth::user()->point1-=50;
            \Auth::user()->save();
            $user=User::where('name',$request->act_user)->first();
            $user->is_pass=1;
            $user->pass_time=date('Y-m-d H:i:s');
            $user->save();
        }else
            return view('home.act_user');
    }
}
