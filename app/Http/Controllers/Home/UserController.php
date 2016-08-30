<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;

class UserController extends Controller
{

    public function child_list()
    {
        $child_list=\Auth::user()->children()->paginate(12);;
        return view('home.child_list',[
            'child_list'=>$child_list
        ]);
    }
}
