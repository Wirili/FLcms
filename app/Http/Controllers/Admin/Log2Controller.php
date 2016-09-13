<?php

namespace App\Http\Controllers\admin;

use App\Models\LogPoint2;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class log2Controller extends Controller
{
    //
    protected $breadcrumb = [];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        $this->breadcrumb[] = ['url' => \URL::route('admin.log2.index'), 'title' => trans('log2.list')];
    }

    public function index()
    {
        if (!$this->adminGate('log2_show')) {
            return $this->Msg(trans('sys.no_permission'), '', 'error');
        }
        return view('admin.log2_index', [
            'page_title' => trans('log2.list'),
            'breadcrumb' => $this->breadcrumb
        ]);
    }

    public function del($id)
    {
        if (!$this->adminGate('log2_del')) {
            return $this->Msg(trans('sys.no_permission'), '', 'error');
        }
        $log2 = LogPoint2::find($id);
        if ($log2) {
            $log2->delete();
            return $this->Msg(trans('log2.del_success'), \URL::route('admin.log2.index'));
        } else
            return $this->Msg(trans('log2.del_fail'), \URL::route('admin.log2.index'), 'error');
    }

    public function create()
    {
        if (!$this->adminGate('log2_new')) {
            return $this->Msg(trans('sys.no_permission'), '', 'error');
        }
        $this->breadcrumb[] = ['url' => 'javascript:void(0)', 'title' => trans('farm.create')];
        return view('admin.log2_edit', [
            'page_title' => trans('log2.create'),
            'breadcrumb' => $this->breadcrumb,
        ]);
    }

    public function save(Request $request)
    {
        if (!$this->adminGate(['log2_new', 'log2_edit'])) {
            return $this->Msg(trans('sys.no_permission'), '', 'error');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|exists:users,name',
            'price' => 'required|numeric'
        ], [
            'name.required' => '请填写用户编号',
            'name.exists' => '用户编号不存在',
            'price.required' => '请填写金额',
            'price.numeric' => '请填写数字'
        ]);

        if ($validator->fails()) {
            return $this->Msg('', null, 'error')->withErrors($validator);
        }
        $user = User::where('name', $request->name)->first();
        $user->point2 += intval($request->price);
        $user->save();
        LogPoint2::create([
            'type' => trans('log2.type.admin'),
            'about' => $request->has('about') ? $request->about : trans('log2.about.admin'),
            'price' => intval($request->price),
            'user_id' => $user->user_id,
        ]);

        return $this->Msg(trans('log2.save_success'), \URL::route('admin.log2.index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = LogPoint2::with('user')->orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = LogPoint2::count();
        $recordsFiltered = LogPoint2::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
