<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Pet;

class PetController extends Controller
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
        $this->breadcrumb[]=['url'=>\URL::route('admin.pet.index'),'title'=>trans('pet.list')];
    }

    public function index()
    {
        if(!$this->adminGate('pet_show')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        return view('admin.pet_index',[
            'page_title'=>trans('pet.list'),
            'breadcrumb'=>$this->breadcrumb
        ]);
    }

    public function edit($id)
    {
        if(!$this->adminGate('pet_edit')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $this->breadcrumb[]=['url'=>'javascript:void(0)','title'=>trans('pet.edit')];
        $pet = Pet::find($id);
        return view('admin.pet_edit', [
            'page_title'=>trans('pet.edit'),
            'breadcrumb'=>$this->breadcrumb,
            'pet' => $pet
        ]);
    }

    public function create()
    {
        if(!$this->adminGate('pet_new')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $this->breadcrumb[]=['url'=>'javascript:void(0)','title'=>trans('pet.create')];
        $pet = new Pet();
        return view('admin.pet_edit', [
            'page_title'=>trans('pet.create'),
            'breadcrumb'=>$this->breadcrumb,
            'pet' => $pet
        ]);
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['pet_new','pet_edit'])){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
//        $validator = Validator::make($request->all(), $this->rules, $this->messages);
//        if ($validator->fails()) {
//            return $this->Msg('',null,'error')->withErrors($validator);
//        }
        if ($request->has('pet_id')) {
            $pet=Pet::find($request->pet_id);
        } else {
            $pet = new Pet();
        }
        //保存图片
        $file=$request->file('image_url');
        if($file->isValid()) {
            $ext=$file->getClientOriginalExtension();
            $filename = '/data/pet/' . $request->pet_id . "_" . date('YmsHis') . rand(10000, 99999) . ".".$ext;
            \Storage::disk('images')->put($filename, \File::get($file));
            if($pet->image)
                \Storage::disk('images')->delete($pet->image);
            $pet->image=$filename;
        }

        $pet->title = $request->title;
        $pet->point2_day = $request->input('point2_day',0);
        $pet->life = $request->input('life',0);
        $pet->money = $request->input('money',0);
        $pet->min_level = $request->input('min_level',0);
        $pet->buy_limit = $request->input('buy_limit',0);
        $pet->max_limit = $request->input('max_limit',0);
        $pet->sort_order = $request->input('sort_order',100);
        $pet->add_time = date('Y-m-d');
        $pet->save();

        return $this->Msg(trans('pet.save_success'),\URL::route('admin.pet.index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = Pet::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = Pet::count();
        $recordsFiltered = Pet::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
