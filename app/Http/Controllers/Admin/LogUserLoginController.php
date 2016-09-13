<?php

namespace App\Http\Controllers\admin;

use App\models\LogUserLogin;
use Illuminate\Http\Request;

class LogUserLoginController extends Controller
{
    //
    protected $breadcrumb=[];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        $this->breadcrumb[]=['url'=>\URL::route('admin.loguserlogin.index'),'title'=>trans('loguserlogin.list')];
    }

    public function index()
    {
        if(!$this->adminGate('loguserlogin_show')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        return view('admin.loguserlogin_index',[
            'page_title'=>trans('loguserlogin.list'),
            'breadcrumb'=>$this->breadcrumb
        ]);
    }

    public function del($id)
    {
        if(!$this->adminGate('loguserlogin_del')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $userlogin = LogUserLogin::find($id);
        if($userlogin) {
            $userlogin->delete();
            return $this->Msg(trans('loguserlogin.del_success'),\URL::route('admin.loguserlogin.index'));
        }else
            return $this->Msg(trans('loguserlogin.del_fail'),\URL::route('admin.loguserlogin.index'),'error');
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = LogUserLogin::with('user')->orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = LogUserLogin::count();
        $recordsFiltered = LogUserLogin::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
