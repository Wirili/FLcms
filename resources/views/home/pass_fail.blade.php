@extends('home.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            账号未激活，请联系网站客服！
            @if(Auth::check())
                <a href="{{URL::route('logout')}}">注销</a>
            @else
                <a href="{{URL::route('login')}}">返回</a>
            @endif
        </div>
    </div>
</div>
@endsection
