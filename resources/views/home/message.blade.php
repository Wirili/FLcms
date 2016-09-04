@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.mail') <small>@lang('menu.message')</small></h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="{{URL::route('index')}}">@lang('menu.index')</a></li>
            <li>@lang('menu.mail')</li>
            <li class="active">@lang('menu.message')</li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('menu.message')
            </div>
            <div class="panel-body">
                <a href="{{URL::route('message',['act'=>'in'])}}" class="btn btn-info">收件箱</a>
                <a href="{{URL::route('message',['act'=>'out'])}}" class="btn btn-info">发件箱</a>
                <a href="" class="btn btn-info pull-right">写信息</a>
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <td>发件人</td>
                    <td>收件人</td>
                    <td>时间</td>
                    <td>预览</td>
                    <td class="hidden-xs">操作</td>
                </tr>
                @forelse($msg as $item)
                    <tr>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->to_user_name}}</td>
                        <td>{{$item->add_time}}</td>
                        <td>{{$item->info}}</td>
                        <td class="hidden-xs"></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">@lang('web.no_data')</td></tr>
                @endforelse
                    <tr>
                        <td colspan="5" class="text-center custom-pagination">
                        @if($msg->count()>0)
                            {{$msg->render()}}
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
        mgo('22');
    </script>
@endsection