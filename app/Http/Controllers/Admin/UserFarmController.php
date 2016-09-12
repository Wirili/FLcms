<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\UserFarm;

class UserFarmController extends Controller
{
    //
    protected $breadcrumb=[];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        $this->breadcrumb[]=['url'=>\URL::route('admin.userfarm.index'),'title'=>trans('userfarm.list')];
    }

    public function index()
    {
        if(!$this->adminGate('userfarm_show')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        return view('admin.userfarm_index',[
            'page_title'=>trans('userfarm.list'),
            'breadcrumb'=>$this->breadcrumb
        ]);
    }

    public function del($id)
    {
        if(!$this->adminGate('userfarm_del')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $userfarm = UserFarm::find($id);
        if($userfarm) {
            $userfarm->delete();
            return $this->Msg(trans('userfarm.del_success'),\URL::route('admin.userfarm.index'));
        }else
            return $this->Msg(trans('userfarm.del_fail'),\URL::route('admin.userfarm.index'),'error');
    }

    public function settle()
    {

    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = UserFarm::with('user')->orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = UserFarm::count();
        $recordsFiltered = UserFarm::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
