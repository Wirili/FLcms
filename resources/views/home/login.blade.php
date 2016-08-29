@extends('home.layout')

@section('content')
<div class="container-fluid">
    <div class="login-box">
        <div class="login-logo text-center h4">Login</div>
        <div class="login-box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {{--<label for="name" class="col-md-4 control-label">会员编号</label>--}}

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="会员编号" autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {{--<label for="password" class="col-md-4 control-label">登陆密码</label>--}}

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" placeholder="登陆密码">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox pull-left">
                            <label>
                                <input type="checkbox" name="remember"> 记住登录
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            登陆
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-link pull-right" href="{{ url('/password/reset') }}">
                        忘记密码?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        $.backstretch(["/build/default/images/dl.jpg"], {
            fade: 100,
            duration: 100
        });
</script>
@endsection
