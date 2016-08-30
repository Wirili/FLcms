<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\UserFarm;

class FarmController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function farm()
    {
        $farm=UserFarm::where('user_id',\Auth::user()->user_id)->paginate(12);
        return view('home.farm',[
            'farm'=>$farm
        ]);
    }
}
