@extends('admin.layout')

@section('content')
    @include('admin.header')
<div class="content">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.config.save') }}">
        <div class="nav-tabs-custom">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                @foreach($config as $item)
                <li role="presentation" @if($loop->first) class="active" @endif><a href="#{{$item->code}}" aria-controls="{{$item->code}}" role="tab" data-toggle="tab">@lang('config.'.$item->code)</a></li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                @foreach($config as $item)
                <div role="tabpanel" class="tab-pane @if($loop->first) active @endif" id="{{$item->code}}">
                    @foreach($item ->children as $v)
                        <div class="form-group">
                        <label class="col-md-2 control-label" for="{{$v->id}}">@lang('config.'.$v->code)</label>
                        @if($v->type=='select')
                            <div class="col-md-4 form-inline">
                            @foreach($v->store_options as $o)
                            <label class="radio-inline">
                                <input type="radio" name="config[{{$v->id}}]" value="{{$o}}">{{$o}}
                            </label>
                            @endforeach
                            </div>
                        @else
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm" name="config[{{$v->id}}]" value="{{$v->value}}">
                            </div>
                        @endif
                        </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            <div class="text-center" style="padding: 10px 0; border-top: 1px solid #f4f4f4;">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
        </div>
    </form>
</div>
    @include('admin.footer')
@endsection