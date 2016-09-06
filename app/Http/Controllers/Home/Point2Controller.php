<?php

namespace App\Http\Controllers\home;

use App\Models\LogPoint2;
use App\models\UserMsg;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Point2Sell;
use Validator;

class Point2Controller extends Controller
{
    //

    public function sell_list()
    {
        $list=Point2Sell::where([['state','挂单中'],['is_delete',0]])->orderBy('id','asc')->take(5)->get();
        return view('home.point2_sell_list',[
            'page_title' => trans('menu.point2_sell_list'),
            'list'=>$list
        ]);
    }

    public function sell(Request $request)
    {
        //数据验证
        $user=\Auth::user();

        //数据验证
        $validator = Validator::make(array_merge($user->toArray(),$request->all()), [
            'alipay_name' => 'required',
            'alipay_fullname' => 'required',
            'mobile' => 'required',
            'num' => 'required|max:'.$user->point2,
        ], [
            'alipay_name.required' => '请完善个人资料(淘宝账号跟手机)后在出售金币',
            'alipay_fullname.required' => '请完善个人资料(淘宝账号跟手机)后在出售金币',
            'mobile.required' => '请完善个人资料(淘宝账号跟手机)后在出售金币',
            'num.required' => '请输入挂售金币',
            'num.max' => '金币不足',
        ]);
        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return new JsonResponse(['status' => 'error', 'msg' => $validator->errors()->getMessages()]);
            }
        }
        $num=intval($request->num);
        //扣钱
        $user->point2-=$num;
        $user->save();
        //扣钱记录
        LogPoint2::create([
            'user_id'=>$user->user_id,
            'price'=> - $num,
            'about'=>'挂单拍卖金币',
            'ip'=>$request->getClientIp(),
            'type'=>'金币拍卖',
            'add_time'=>date('Y-m-d H:i:s'),
        ]);
        //插入拍卖记录
        $sell=new Point2Sell();
        $sell->user_id=$user->user_id;
        $sell->state='挂单中';
        $sell->alipay_name=$user->alipay_name;
        $sell->alipay_fullname=$user->alipay_fullname;
        $sell->weixin=$user->weixin;
        $sell->mobile=$user->mobile;
        $sell->money=$num;
        $sell->add_time=date('Y-m-d H:i:s');
        $sell->save();
        //系统消息
        UserMsg::create([
            'user_id'=>$user->user_id,
            'info'=>$num.'金币挂单中',
            'type'=>'[系统消息]',
            'ip'=>$request->getClientIp(),
            'add_time'=>date('Y-m-d H:i:s'),
        ]);
        return new JsonResponse(['status' => 'success', 'msg' => '金币拍卖成功']);
    }

    public function buy(Request $request)
    {
        $request->has('id')?$id=$request->id:$id=0;
        //数据验证
        $user=\Auth::user();
        $sell=Point2Sell::find($id);
        if($sell){
            if($user->user_id==$sell->user_id)
                return new JsonResponse(['status' => 'error', 'msg' => '不能购买自己出售的金币']);
            $sell->buy_user_id=$user->user_id;
            $sell->buy_time=date('Y-m-d H:i:s');
            $sell->state='等待买家付款';
            $sell->save();
            return new JsonResponse(['status' => 'success', 'msg' => '购买成功']);
        }else{
            return new JsonResponse(['status' => 'error', 'msg' => '拍卖信息不存在']);
        }
    }

    public function sell_quit(Request $request)
    {
        $request->has('id')?$id=$request->id:$id=0;
        //数据验证
        $user=\Auth::user();
        $sell=Point2Sell::where([['id',$id],['state','挂单中'],['user_id',$user->user_id]])->first();
        if($sell){
            $sell->buy_time=null;
            $sell->state='放弃拍卖';
            $sell->save();
            return new JsonResponse(['status' => 'success', 'msg' => '放弃成功']);
        }else{
            return new JsonResponse(['status' => 'error', 'msg' => '拍卖信息不正确']);
        }
    }

    public function buy_quit(Request $request)
    {
        $request->has('id')?$id=$request->id:$id=0;
        //数据验证
        $user=\Auth::user();
        $sell=Point2Sell::where([['id',$id],['state','等待买家付款'],['buy_user_id',$user->user_id]])->first();
        if($sell){
            $sell->buy_user_id=0;
            $sell->buy_time=null;
            $sell->state='挂单中';
            $sell->save();
            return new JsonResponse(['status' => 'success', 'msg' => '放弃成功']);
        }else{
            return new JsonResponse(['status' => 'error', 'msg' => '拍卖信息不正确']);
        }
    }

    public function buy_log()
    {
        $list=Point2Sell::where('buy_user_id',\Auth::user()->user_id)->paginate(15);
        return view('home.point2_buy_log',[
            'page_title' => trans('menu.point2_buy_log'),
            'list'=>$list
        ]);
    }

    public function sell_log()
    {
        $list=Point2Sell::where('user_id',\Auth::user()->user_id)->paginate(15);
        return view('home.point2_sell_log',[
            'page_title' => trans('menu.point2_sell_log'),
            'list'=>$list
        ]);
    }
}
