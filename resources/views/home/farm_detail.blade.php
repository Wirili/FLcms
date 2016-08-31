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
                    <div class="col-md-12">
                        @forelse($farm_sum as $item)
                            @if($loop->first)
                                共有：
                            @else
                                、
                            @endif
                            {{$item->title.'×'.$item->num}}
                        @empty
                            <div class="text-center">没有数据</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <td class="text-center">市场</td>
                    <td class="text-center hidden-xs">属性</td>
                    <td class="text-center">结算</td>
                </tr>
                @forelse($farm as $item)
                    <tr>
                        <td class="text-center"><img src="{{$item->image}}" alt="{{$item->title}}" height="100"></td>
                        <td class="hidden-xs">
                            <b>{{$item->title}}</b><br>
                            数量：{{$item->num}}<br>
                            每日生产金币数：{{$item->point2_day}}<br>
                            每日总共生产金币数：{{$item->point2_day}}<br>
                        </td>
                        <td>
                            购买时间：{{date('Y-m-d',strtotime($item->add_time))}}<br>
                            宠物寿命：{{date('Y-m-d',strtotime($item->end_time))}}<br>
                            已生产金币：{{$item->settle_len}}天，共{{$item->num*$item->point2_day*$item->settle_len}}金币<br>
                            还可生产金币：{{$item->life-$item->settle_len}}天，共{{$item->num*$item->point2_day*($item->life-$item->settle_len)}}金币<br>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">没有数据</td></tr>
                @endforelse
                    <tr>
                        <td colspan="3" class="text-center custom-pagination">
                        @if($farm->count()>0)
                            {{$farm->render()}}
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