<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;

class UserController extends Controller
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
        $this->breadcrumb[]=['url'=>\URL::route('admin.user.index'),'title'=>trans('user.list')];
    }

    public function index()
    {
        if(!$this->adminGate('user_show')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        return view('admin.user_index',[
            'page_title'=>trans('user.list'),
            'breadcrumb'=>$this->breadcrumb
        ]);
    }

    public function edit($id)
    {
        if(!$this->adminGate('user_edit')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $this->breadcrumb[]=['url'=>'javascript:void(0)','title'=>trans('user.edit')];
        $user = User::find($id);
        return view('admin.user_edit', [
            'page_title'=>trans('user.edit'),
            'breadcrumb'=>$this->breadcrumb,
            'user' => $user
        ]);
    }

    public function create()
    {
        if(!$this->adminGate('user_new')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $this->breadcrumb[]=['url'=>'javascript:void(0)','title'=>trans('user.create')];
        $user = new User();
        return view('admin.user_edit', [
            'page_title'=>trans('user.create'),
            'breadcrumb'=>$this->breadcrumb,
            'user' => $user
        ]);
    }

    public function del($id)
    {
        if(!$this->adminGate('user_del')){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
        $user = User::find($id);
        if($user) {
            $user->delete();
            return $this->Msg(trans('user.del_success'),\URL::route('admin.user.index'));
        }else
            return $this->Msg(trans('user.del_fail'),\URL::route('admin.user.index'),'error');
    }

    public function save(Request $request)
    {
        if(!$this->adminGate(['user_new','user_edit'])){
            return $this->Msg(trans('sys.no_permission'),'','error');
        }
//        $validator = Validator::make($request->all(), $this->rules, $this->messages);
//        if ($validator->fails()) {
//            return $this->Msg('',null,'error')->withErrors($validator);
//        }
        if ($request->has('id')) {
            $user=User::find($request->id);
        } else {
            $user = new User();
            $user->name=$request->name;
            $user->reg_time = date('Y-m-d H:i:s');
        }

        $parent=User::whereName($request->parent_name);
        $user->parent_id = $request->has('parent_id')?User::find($request->parent_id)->parent_id:0;
        $user->is_pass = $request->is_pass;
        $user->level = $request->level;
        if($request->has('password'))
            $user->password = $request->password;
        if($request->has('password2'))
            $user->password2 = $request->password2;
        $user->reg_ip = $request->getClientIp();
        $user->save();

        return $this->Msg(trans('user.save_success'),\URL::route('admin.user.index'));
    }

    public function ajax(Request $request)
    {
        $filter = $request->only(['draw', 'columns', 'order', 'start', 'length']);
        $data = User::orderBy($filter['columns'][$filter['order'][0]['column']]['data'], $filter['order'][0]['dir'])->forPage($filter['start'] / $filter['length'] + 1, $filter['length'])->get();
        $recordsTotal = User::count();
        $recordsFiltered = User::count();
        return [
            'draw' => intval($filter['draw']),
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsFiltered),
            'data' => $data->toArray()
        ];
    }
}
