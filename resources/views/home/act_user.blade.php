@extends('home.content')

@section('right')
<div class="row">
    <div class="col-md-12">
        <h3>@lang('menu.user_manager') <small>@lang('menu.act_user')</small></h3>
        <ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">@lang('menu.index')</a></li>
            <li><a href="#">@lang('menu.user_manager')</a></li>
            <li class="active">@lang('menu.act_user')</li>
        </ol>
    </div>
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('menu.act_user')
        </div>
        <div class="panel-body">
            <div class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-md-2 control-label" for="">@lang('user.point1_bal')</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm" disabled value="{{Auth::user()->point1}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="">@lang('user.point1_act')</label>
                    <div class="col-md-4">
                        <input type="text" id="user_act_point1" class="form-control input-sm" disabled value="{{intval($C['user_act_point1'])}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="">@lang('user.act_user_label')</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm" id="act_user" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-2 help-block" id="msg"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        <button type="submit" class="btn btn-warning act_user_btn">@lang('user.act_user_btn')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        mgo('23');
        $(function(){
            $('.act_user_btn').on('click',function(e){
                var load=layer.load();
                $.ajax({
                    type: 'POST',
                    url: '{{URL::route('act_user')}}',
                    data: {_token:'{{csrf_token()}}',act_user:$('#act_user').val()},
                    complete:function(result,status){
                        debugger;
                        layer.close(load);
                        if(result.status==422){
                            $.each(result.responseJSON,function(id,arr){
                                var str="";
                                $.each(arr,function(a,b){
                                    str+=b+"<br>";
                                });
                                layer.tips(str, '#'+id,{
                                    tips: [1, '#ec971f'],
                                    time: 2000,
                                    tipsMore:true
                                });
                            });
                        }else if(result.status==200){
                            layer.alert(result.responseJSON.msg, {
                                closeBtn: 0
                            }, function(){
                                window.location.reload(true);
                            });
                        }
                    },
                    dataType: 'json'
                });
            });

            $('#act_user').on('input propertychange',function(e){
                $.ajax({
                    type:'POST',
                    url: '{{URL::route('get_user')}}',
                    data: {_token:'{{csrf_token()}}',act_user:$('#act_user').val()},
                    success:function(result){
                        if($('#act_user').val())
                            $('#msg').html(result);
                        else
                            $('#msg').html('');
                    },
                    dataType: 'json'
                });
            })
        });
    </script>
@endsection