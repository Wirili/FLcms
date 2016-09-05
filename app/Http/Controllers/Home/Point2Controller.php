<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Point2Sell;

class Point2Controller extends Controller
{
    //

    public function sell_list()
    {
        $list=Point2Sell::where([['state','挂单中'],['is_delete',0],['user_id','<>',\Auth::user()->user_id]])->orderBy('id','asc')->take(5)->get();
        return view('home.point2_sell_list',[
            'page_title' => trans('menu.point2_sell_list'),
            'list'=>$list
        ]);
    }

    public function buy($id)
    {
        return new JsonResponse(['status' => 'success', 'msg' => '购买宠物成功']);
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
