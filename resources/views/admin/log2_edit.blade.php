@extends('admin.layout')

@section('content')
    @include('admin.header')
<div class="content">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.log2.save') }}" enctype="multipart/form-data">
        <div class="nav-tabs-custom">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('log2.tab_basic')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">@lang('log2.label.name')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="name" id="name"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="price">@lang('log2.label.price')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="price" id="price"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="about">@lang('log2.label.about')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="about" id="about"></div>
                    </div>
                </div>
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