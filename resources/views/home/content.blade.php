@extends('home.layout')

@section('content')
    <div class="container-fluid top clearfix">
        <div class="row clearfix">
            <div class="col-sm-4 logo">
                <img src="/build/default/images/logo2.png" alt="" height="100";>
            </div>
            <div class="col-sm-8 an">
                <div class="btn-group btn-group-lg">
                    <button type="button" class="btn btn-default clearfix visible-xs-block menu-btn"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
                    <button type="button" class="btn btn-default clearfix"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span><span class="hidden-xs"> @lang('menu.home')</span></button>
                    <button type="button" class="btn btn-default clearfix"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><span class="hidden-xs"> @lang('menu.mail')</span></button>
                    <div class="btn-group btn-group-lg" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{Auth::user()->name}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#"> @lang('menu.modify_user')</a></li>
                            <li><a href="#"> @lang('menu.password_protected')</a></li>
                            <li><a href="#"> @lang('menu.login_log')</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{URL::route('logout')}}"><span class="glyphicon glyphicon-off"></span> @lang('menu.logout')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main clearfix">
        <!--LEFT -->
        <div class="left pull-left">     <div class="btn-group-vertical choujiang"><a href="/member/lottery.php" target="_blank"><img src="/build/default/images/cj.gif" /></a></div>
            <div class="btn-group-vertical">
                <ul>
                    <li>
                        <a class="btn btn-long" href="{{URL::route('index')}}" id="mlindex"><span class="glyphicon glyphicon-home llong0" aria-hidden="true"></span><span class="llong2">@lang('menu.home')</span></a>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-piggy-bank llong0" aria-hidden="true"></span><span class="llong2">@lang('menu.farm_manager')</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">
                            <li><a class="btn btn-long8" href="{{URL::route('farm')}}" id="m11">@lang('menu.farm')</a></li>
                            <li><a class="btn btn-long8" href="{{URL::route('farm_detail')}}" id="m12">@lang('menu.farm_detail')</a></li>
                            <li><a class="btn btn-long8" href="/member/farm_shop.php" id="m13">@lang('menu.farm_shop')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-user llong0" aria-hidden="true"></span><span class="llong2">@lang('menu.user_manager')</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">
                            <li><a class="btn btn-long8" href="/member/rr.php" id="m21">@lang('menu.user_child')</a></li>
                            <li><a class="btn btn-long8" href="{{URL::route('child_list')}}" id="m22">@lang('menu.child_list')</a></li>
                            <li><a class="btn btn-long8" href="{{URL::route('act_user')}}" id="m23">@lang('menu.act_user')</a></li>
                            <li><a class="btn btn-long8" href="{{URL::route('act_user_log')}}" id="m26">@lang('menu.act_user_log')</a></li>

                        </ul>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-usd llong0" aria-hidden="true"></span><span class="llong2">@lang('menu.account_detail')</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">

                            <li><a class="btn btn-long8" href="/member/point2_log_in.php" id="m31">@lang('menu.account_point2_in')</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_log_out.php" id="m32">@lang('menu.account_point2_ex')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-retweet llong0" aria-hidden="true"></span><span class="llong2">交易系统</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">
                            <li><a class="btn btn-long8" href="/member/point2_sell_list.php" id="m45">金币拍卖</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_buy_log.php" id="m46">金币购买记录</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_sell_log.php" id="m47">金币卖出记录</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_transfer.php" id="m42">金币转账</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_withdraw.php" id="m44">申请提现</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_withdraw_log.php" id="m44">提现记录</a></li>
                        </ul>
                    </li>

                    <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-shopping-cart llong0" aria-hidden="true"></span><span class="llong2">购买商品</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                    <ul class="sub-menu">
                        <li><a class="btn btn-long8" href="/member/point2_shop.php" id="m51">商城购物</a></li>
                        <li><a class="btn btn-long8" href="/member/point2_shop_order.php" id="m52">我的订单</a></li>
                    </ul>

                </ul>
            </div>
        </div>
        <div class="right container-fluid">
            @yield('right')
        </div>
    </div>
@endsection