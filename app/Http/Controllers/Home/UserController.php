<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\User;
use App\Models\LogPoint1;
use App\Models\LogPoint2;
use App\Models\LogUserLogin;


class UserController extends Controller
{

    /**
     * 推荐结构
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\View\View
     */
    public function user_child(Request $request)
    {
        if ($request->isMethod('POST')) {
            $tree[] = $this->getTree(\Auth::user()->user_id);
            return new JsonResponse($tree, 200);
        }
        return view('home.user_child',[
            'page_title'=>trans('menu.user_child')
        ]);
    }

    /**
     * 直推列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function child_list()
    {
        $child_list = \Auth::user()->children()->paginate(12);;
        return view('home.child_list', [
            'child_list' => $child_list
        ]);
    }

    /**
     * 激活玩家
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\View\View
     */
    public function act_user(Request $request)
    {
        if ($request->isMethod('POST')) {
            //数据验证
            $validator = Validator::make(array_merge($request->all(), ['user_act_point1' => \Auth::user()->point1]), [
                'act_user' => 'required|not_in:' . \Auth::user()->name . '|exists:users,name,name,' . $request->act_user . ',is_pass,0',
                'user_act_point1' => 'numeric|min:' . $this->config['user_act_point1']
            ], trans('user.act_user_validator'));
            if ($validator->fails()) {
                if ($request->expectsJson()) {
                    return new JsonResponse($validator->errors()->getMessages(), 422);
                }
            }

            //当前时间
            $date = date('Y-m-d H:i:s');

            //激活玩家编号
            \Auth::user()->point1 -= intval($this->config['user_act_point1']);
            \Auth::user()->save();
            $user = User::where('name', $request->act_user)->first();
            $user->is_pass = 1;
            $user->pass_time = $date;
            $user->save();

            //记录激活日志
            $log = new LogPoint1();
            $log->user_id = \Auth::user()->user_id;
            $log->price = intval($this->config['user_act_point1']);
            $log->about = trans('log1.about.act_user', ['name' => $request->act_user]);
            $log->ip = $request->getClientIp();
            $log->type = trans('log1.type.act_user');
            $log->add_time = $date;
            $log->save();
            return new JsonResponse(['msg' => trans('user.act_user_success', ['name' => $request->act_user])], 200);
        } else
            return view('home.act_user');
    }

    /**
     * 激活记录
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function act_user_log(Request $request)
    {
        $log = LogPoint1::where('user_id', \Auth::user()->user_id)->paginate(12);
        return view('home.act_user_log', [
            'log' => $log
        ]);
    }

    /**
     * 金币收入明细
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function point2_log_in()
    {
        $log = LogPoint2::where('user_id', \Auth::user()->user_id)->where('price','>','0')->paginate(12);
        return view('home.point2_log_in', [
            'log' => $log
        ]);
    }

    /**
     * 金币支出明细
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function point2_log_out()
    {
        $log = LogPoint2::where('user_id', \Auth::user()->user_id)->where('price','<','0')->paginate(12);
        return view('home.point2_log_out', [
            'log' => $log
        ]);
    }

    /**
     * 用户登陆日志
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function log_login()
    {
        $log=LogUserLogin::where('user_id',\Auth::user()->user_id)->paginate(12);
        return view('home.log_login',[
            'log'=>$log
        ]);
    }

    public function user_info()
    {
        return view('home.user_info');
    }

    /**
     * ajax获取用户信息
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get_user(Request $request)
    {
        $user = User::where('name', $request->act_user)->first();
        if ($user) {
            return new JsonResponse(trans('user.get_user_info.exist', [
                'name' => $user->fullname,
                'is_pass' => trans('user.is_pass_option')[$user->is_pass],
                'reg_time' => $user->reg_time,
                'parent_name' => $user->parent_name
            ]), 200);
        }
        return new JsonResponse(trans('user.get_user_info.not_exist'), 200);
    }

    /**
     * 递归获取推荐用户
     *
     * @param $user_id
     * @return mixed
     */
    protected function getTree($user_id)
    {
        $user = User::with('children')->find($user_id);
        foreach ($user->children as $item) {
            $nodes[] = $this->getTree($item->user_id);
        }
        $arr['text'] = trans('user.level')[$user->level] . ' ' . $user->name;
        $arr['tags'] = [$user->children->count()];
        if (isset($nodes))
            $arr['nodes'] = $nodes;
        return $arr;
    }
}
