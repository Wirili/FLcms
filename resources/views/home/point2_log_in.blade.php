@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.account_detail') <small>@lang('menu.point2_log_in')</small></h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="{{URL::route('index')}}">@lang('menu.index')</a></li>
            <li>@lang('menu.account_detail')</li>
            <li class="active">@lang('menu.point2_log_in')</li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('menu.point2_log_in')
            </div>
            <div class="panel-body">
                <p class="col-sm-6 col-md-3">金币余额: <strong>{{\Auth::user()->point2}}</strong>金币</p>
                <p class="col-sm-6 col-md-3">您总共收入: <strong>{{App\Models\LogPoint2::where('price','>',0)->sum('price')}}</strong>金币</p>
                <p class="col-sm-6 col-md-3">宠物产币: <strong>140.00</strong>金币</p>
                <p class="col-sm-6 col-md-3">直荐激活奖: <strong>140.00</strong>金币</p>
                <p class="col-sm-6 col-md-3">每日推荐分红: <strong>140.00</strong>金币</p>
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <td>@lang('log2.label.id')</td>
                    <td>@lang('log2.label.type')</td>
                    <td>@lang('log2.label.price')</td>
                    <td>@lang('log2.label.about')</td>
                    <td class="hidden-xs">@lang('log2.label.add_time')</td>
                </tr>
                @forelse($log as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->typ}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->about}}</td>
                        <td class="hidden-xs">{{$item->add_time}}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">@lang('web.no_data')</td></tr>
                @endforelse
                    <tr>
                        <td colspan="5" class="text-center custom-pagination">
                        @if($log->count()>0)
                            {{$log->render()}}
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
        mgo('31');
    </script>
@endsection