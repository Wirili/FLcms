@extends('home.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            @lang('web.pass_fail')
            @if(Auth::check())
                <a href="{{URL::route('logout')}}">@lang('web.logout')</a>
            @else
                <a href="{{URL::route('login')}}">@lang('web.back')</a>
            @endif
        </div>
    </div>
</div>
@endsection
