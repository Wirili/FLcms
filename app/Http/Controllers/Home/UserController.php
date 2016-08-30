<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use Validator;

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
            $validator = Validator::make($request->all(), [], []);
        }else
            return view('home.act_user');
    }
}
