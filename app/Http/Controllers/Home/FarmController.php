<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\UserFarm;

class FarmController extends Controller
{
    public function farm()
    {
        $farm=UserFarm::where('is_end',0)->where('user_id',\Auth::user()->user_id)->paginate(12);
        return view('home.farm',[
            'farm'=>$farm
        ]);
    }
    public function farm_detail()
    {
        $farm_sum=UserFarm::where('is_end',0)->where('user_id',\Auth::user()->user_id)->groupBy('farm_id')->select(\DB::raw('max(title) as title,sum(num) as num'))->get();
        $farm=UserFarm::where('is_end',0)->where('user_id',\Auth::user()->user_id)->paginate(12);
        return view('home.farm_detail',[
            'farm'=>$farm,
            'farm_sum'=>$farm_sum,
        ]);
    }
}
