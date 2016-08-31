<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\User;
use App\Models\LogPoint1;
use App\Models\LogPoint2;



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

            $log=new LogPoint1();
            $log->user_id=\Auth::user()->user_id;
            $log->price=50;
            $log->about='';
            $log->ip=$request->getClientIp();
            $log->type='激活玩家';
            $log->add_time=date('Y-m-d H:i:s');
            $log->save();
//            LogPoint1::create([
//                'user_id'=>\Auth::user()->user_id,
//                'price'=>50,
//                'about'=>'adsf',
//                'ip'=>$request->getClientIp(),
//                'type'=>'激活玩家',
//                'add_time'=>date('Y-m-d H:i:s')
//            ]);

        }else
            return view('home.act_user');
    }

    public function get_user(Request $request)
    {
        $user=User::where('name',$request->act_user)->first();
        if($user){
            return new JsonResponse('玩家姓名：'.($user->fullname?$user->fullname:'(未填写)').'，激活状态：'.(trans('user.is_pass_option')[$user->is_pass]).'，注册时间：'.$user->reg_time.'，上级编号：'.$user->parent_name,200);
        }
        return new JsonResponse('您输入的玩家编号不存在',200);
    }
}
