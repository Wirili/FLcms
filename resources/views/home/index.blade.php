@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.home')</h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="{{URL::route('index')}}">@lang('menu.index')</a></li>
        </ol>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <td>@lang('user.name'): {{ Auth::user()->name }}</td>
                <td>@lang('user.fullname'): {{ Auth::user()->fullname }}</td>
            </tr>
            <tr>
                <td>@lang('user.parent'): {{ Auth::user()->parent_name }}</td>
                <td>@lang('user.is_pass'): {{trans('user.is_pass_option')[Auth::user()->is_pass]}}</td>
            </tr>
            <tr>
                <td>@lang('user.child_count'): {{ Auth::user()->children->count() }}</td>
                <td>@lang('user.level_label'): {!! trans('user.level')[Auth::user()->level] !!}</td>
            </tr>
            <tr>
                <td>@lang('user.point2'): {{ Auth::user()->point2 }}</td>
                <td>@lang('user.point2sum'): 0</td>
            </tr>
            <tr>
                <td>@lang('user.point1'): {{ Auth::user()->point1 }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="form-horizontal">
                        <label for="" class="control-label col-md-2">@lang('user.referral_link')</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm">
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn btn-info">@lang('user.click_copy')</a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('new.new') <a href="">@lang('new.all')</a>
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <td>@lang('new.title')</td>
                    <td>@lang('new.add_time')</td>
                </tr>
                @foreach($article as $item)
                    <tr>
                        <td><a href="#">{{$item->title}}</a></td>
                        <td>{{$item->add_time}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $("#mlindex").addClass("btn-long16");
    </script>
@endsection