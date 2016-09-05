@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.trade_manager') <small>@lang('menu.point2_sell_list')</small></h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="{{URL::route('index')}}">@lang('menu.index')</a></li>
            <li>@lang('menu.trade_manager')</li>
            <li class="active">@lang('menu.point2_sell_list')</li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('menu.point2_sell_list')
            </div>
            <div class="panel-body">
                @lang('point2.sell_info')
                <button class="btn btn-success">@lang('point2.sell_btn')</button><br>
                @lang('point2.sell_desc')
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <td>@lang('point2.label.id')</td>
                    <td>@lang('point2.label.money')</td>
                    <td class="hidden-xs">@lang('point2.label.add_time')</td>
                    <td>@lang('point2.label.handle')</td>
                </tr>
                @forelse($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->money}}</td>
                        <td class="hidden-xs">{{$item->add_time}}</td>
                        <td><a href="{{URL::route('point2_buy',['id'=>$item->id])}}" class="btn btn-danger btn-xs">我要抢购</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">@lang('web.no_data')</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        mgo('45');
    </script>
@endsection