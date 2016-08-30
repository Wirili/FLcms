@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.farm_manager') <small>@lang('menu.farm')</small></h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">@lang('menu.index')</a></li>
            <li><a href="#">@lang('menu.farm_manager')</a></li>
            <li class="active">@lang('menu.farm')</li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('menu.farm')
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <td>玩家编号</td>
                    <td>玩家姓名</td>
                    <td>VIP等级</td>
                    <td>激活状态</td>
                    <td>账号状态</td>
                    <td>最后登录时间</td>
                    <td>注册时间</td>
                </tr>
                @forelse($child_list as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{!! trans('user.level')[$item->level] !!}</td>
                        <td>{{ trans('user.is_pass_option')[$item->is_pass] }}</td>
                        <td>{{ trans('user.is_lock_option')[$item->is_lock]}}</td>
                        <td>{{$item->last_time}}</td>
                        <td>{{$item->reg_time}}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">没有数据</td></tr>
                @endforelse
                    <tr>
                        <td colspan="7" class="text-center">
                        @if($child_list->count()>0)
                            {{$child_list->render()}}
                        @endif
                        </td>
                    </tr>
            </table>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        mgo('12');
    </script>
@endsection