@extends('home.layout')

@section('content')
    <div class="container-fluid top clearfix">
        <div class="row clearfix">
            <div class="col-sm-4 logo">
                <img src="/build/default/images/logo2.png" alt="" height="100";>
            </div>
            <div class="col-sm-8 an">
                <div class="btn-group btn-group-lg">
                    <button type="button" class="btn btn-default clearfix"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> 乐园公告</button>
                    <button type="button" class="btn btn-default clearfix"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 站内信</button>
                    <div class="btn-group btn-group-lg" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">修改资料</a></li>
                            <li><a href="#">密码保护</a></li>
                            <li><a href="#">登陆日志</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><span class="glyphicon glyphicon-off"></span> 注销登陆</a></li>
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
                        <a class="btn btn-long" href="{{URL::route('index')}}" id="mlindex"><span class="glyphicon glyphicon-home llong0" aria-hidden="true"></span><span class="llong2">乐园首页</span></a>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-piggy-bank llong0" aria-hidden="true"></span><span class="llong2">乐园管理</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">
                            <li><a class="btn btn-long8" href="{{URL::route('farm')}}" id="m11">我的乐园</a></li>
                            <li><a class="btn btn-long8" href="/member/my_farm_detailed.php" id="m13">我的乐园(详单)</a></li>
                            <li><a class="btn btn-long8" href="/member/farm_shop.php" id="m12">乐园商店</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-user llong0" aria-hidden="true"></span><span class="llong2">账户管理</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">
                            <li><a class="btn btn-long8" href="/member/rr.php" id="m21">推荐结构</a></li>
                            <li><a class="btn btn-long8" href="/member/com_list.php" id="m22">直推列表</a></li>
                            <li><a class="btn btn-long8" href="/member/act_mer.php" id="m23">激活账号</a></li>
                            <li><a class="btn btn-long8" href="/member/act_mer_log.php" id="m26">激活记录</a></li>

                        </ul>
                    </li>
                    <li>
                        <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-usd llong0" aria-hidden="true"></span><span class="llong2">收支明细</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                        <ul class="sub-menu">

                            <li><a class="btn btn-long8" href="/member/point2_log_in.php" id="m31">金币收入</a></li>
                            <li><a class="btn btn-long8" href="/member/point2_log_out.php" id="m32">金币支出</a></li>
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