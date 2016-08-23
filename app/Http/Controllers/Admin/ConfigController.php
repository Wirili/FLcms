<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Config;

class ConfigController extends Controller
{
    //
    protected $breadcrumb=[];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        $this->breadcrumb[]=['url'=>\URL::route('admin.config.edit'),'title'=>trans('config.edit')];
    }

    public function edit()
    {
//        if(!$this->adminGate('config_edit')){
//            return $this->Msg(trans('sys.no_permission'),'','error');
//        }
        $config=Config::whereParentId(0)->get();
        return view('admin.config_edit',[
            'page_title'=>trans('config.edit'),
            'breadcrumb'=>$this->breadcrumb,
            'config'=>$config
        ]);
    }

    public function save()
    {
        return $this->Msg(trans('config.save_success'),\URL::route('admin.config.index'));
    }
}
