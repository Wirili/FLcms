@extends('admin.layout')

@section('content')
    @include('admin.header')
<div class="content">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.pet.save') }}" enctype="multipart/form-data">
        <div class="nav-tabs-custom">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('pet.tab_basic')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="display_name">@lang('pet.title')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="title"  value="{{$pet->title}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">@lang('pet.point2_day')</label>
                        <div class="col-md-4"><input type="number" class="form-control input-sm" name="name"  value="{{$pet->point2_day}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.life')</label>
                        <div class="col-md-4"><input type="number" class="form-control input-sm" name="description" value="{{$pet->life}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.money')</label>
                        <div class="col-md-4"><input type="number" class="form-control input-sm" name="description" value="{{$pet->money}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.min_level')</label>
                        <div class="col-md-4">
                            <select class="form-control" name="min_level">
                                <option value="0" @if($pet->min_level==0) selected @endif>@lang('pet.pls')</option>
                                <option value="1" @if($pet->min_level==1) selected @endif>@lang('config.level1')</option>
                                <option value="2" @if($pet->min_level==2) selected @endif>@lang('config.level2')</option>
                                <option value="3" @if($pet->min_level==3) selected @endif>@lang('config.level3')</option>
                                <option value="4" @if($pet->min_level==4) selected @endif>@lang('config.level4')</option>
                                <option value="5" @if($pet->min_level==5) selected @endif>@lang('config.level5')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.buy_limit')</label>
                        <div class="col-md-4"><input type="number" class="form-control input-sm" name="description" value="{{$pet->buy_limit}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.max_limit')</label>
                        <div class="col-md-4"><input type="number" class="form-control input-sm" name="description" value="{{$pet->max_limit}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.sort_order')</label>
                        <div class="col-md-4"><input type="number" class="form-control input-sm" name="description" value="{{$pet->sort_order}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('pet.image')</label>
                        <div class="col-md-4"><input type="file" name="image_url" ></div>
                    </div>
                    @if($pet->image)
                    <div class="form-group">
                        <div class="col-md-offset-2"><img src="{{$pet->image}}" height="150" alt="{{$pet->title}}"></div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="text-center" style="padding: 10px 0; border-top: 1px solid #f4f4f4;">
                <input type="hidden" name="pet_id" value="{{$pet->pet_id}}">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
        </div>
    </form>
</div>
    @include('admin.footer')
@endsection