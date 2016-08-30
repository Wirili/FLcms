<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Farm;

class FarmController extends Controller
{
    //
    protected $breadcrumb=[];

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'same:password_confirm',
    ];

    protected $messages = [
        'name.required' => '请输入管理员名称',
        'email.required' => '请输入电子邮件',
        'password.same' => '两次密码不相同',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        $this->breadcrumb[]=['url'=>\URL::route('admin.farm.index'),'title'=>trans('farm.list')];
    }

    public function index()
    {
        if(!$this->adminGate('farm_show')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        return view('admin.farm_index',[
            'page_title'=>trans('farm.list'),
            'breadcrumb'=>$this->breadcrumb
        ]);
    }

    public function edit($id)
    {
        if(!$this->adminGate('farm_edit')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $this->breadcrumb[]=['url'=>'javascript:void(0)','title'=>trans('farm.edit')];
        $farm = Farm::find($id);
        return view('admin.farm_edit', [
            'page_title'=>trans('farm.edit'),
            'breadcrumb'=>$this->breadcrumb,
            'farm' => $farm
        ]);
    }

    public function create()
    {
        if(!$this->adminGate('farm_new')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $this->breadcrumb[]=['url'=>'javascript:void(0)','title'=>trans('farm.create')];
        $farm = new Farm();
        return view('admin.farm_edit', [
            'page_title'=>trans('farm.create'),
            'breadcrumb'=>$this->breadcrumb,
            'farm' => $farm
        ]);
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['farm_new','farm_edit'])){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
//        $validator = Validator::make($request->all(), $this->rules, $this->messages);
//        if ($validator->fails()) {
//            return $this->Msg('',null,'error')->withErrors($validator);
//        }
        if ($request->has('id')) {
            $farm=Farm::find($request->id);
        } else {
            $farm = new Farm();
        }
        //保存图片
        $file=$request->file('image_url');
        if($file&&$file->isValid()) {
            $ext=$file->getClientOriginalExtension();
            $filename = '/data/Farm/' . $request->id . "_" . date('YmsHis') . rand(10000, 99999) . ".".$ext;
            \Storage::disk('images')->put($filename, \File::get($file));
            if($farm->image)
                \Storage::disk('images')->delete($farm->image);
            $farm->image=$filename;
        }

        $farm->title = $request->title;
        $farm->point2_day = $request->input('point2_day',0);
        $farm->life = $request->input('life',0);
        $farm->money = $request->input('money',0);
        $farm->min_level = $request->input('min_level',0);
        $farm->buy_limit = $request->input('buy_limit',0);
        $farm->max_limit = $request->input('max_limit',0);
        $farm->sort_order = $request->input('sort_order',100);
        $farm->add_time = date('Y-m-d');
        $farm->save();

        return $this->Msg(trans('farm.save_success'),\URL::route('admin.farm.index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Farm::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Farm::count();
        $recordsFiltered = Farm::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
