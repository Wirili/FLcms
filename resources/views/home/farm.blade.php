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
        <div class="panel-body">
            <div class="row">
                @forelse($farm as $item)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{$item->image}}" alt="{{$item->title}}">
                        <div class="caption">
                            <h3>
                                {{$item->title.$item->id}}号<span class="badge">{{$item->num}}</span>
                            </h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: {{floatval($item->settle_len)/floatval($item->life)*100}}%;">
                                    {{$item->settle_len}}天
                                </div>
                            </div>
                            <p>已产金币：<strong>{{$item->num*$item->point2_day*$item->settle_len}}</strong>/待产金币：<strong>{{$item->num*$item->point2_day*($item->life-$item->settle_len)}}</strong></p>
                            <p>购买日期：{{date('Y-m-d',strtotime($item->add_time))}}</p>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="text-center">没有数据</div>
                @endforelse
            </div>
            @if($farm->count()>0)
            <div class="row">
                <div class="col-md-12 text-center">
                    {{$farm->render()}}
                </div>
            </div>
            @endif
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