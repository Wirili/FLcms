@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.user_manager') <small>@lang('menu.act_user')</small></h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">@lang('menu.index')</a></li>
            <li><a href="#">@lang('menu.user_manager')</a></li>
            <li class="active">@lang('menu.act_user')</li>
        </ol>
    </div>
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('menu.act_user')
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{URL::route('act_user')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-2 control-label" for="">@lang('user.point1_bal')</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm" disabled value="{{Auth::user()->point1}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="">@lang('user.point1_act')</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm" disabled value="{{intval($C['user_act_point1'])}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="">@lang('user.act_user_label')</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        <button type="submit" class="btn btn-warning">@lang('user.act_user_btn')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        mgo('11');
    </script>
@endsection