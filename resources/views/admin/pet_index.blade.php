@extends('admin.layout')

@section('content')
    @include('admin.header')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <table id="dt" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr align="center">
                                <th class="text-center" width="60">@lang('sys.id')</th>
                                <th class="text-center" width="80">@lang('pet.title')</th>
                                <th class="text-center" width="150">@lang('pet.image')</th>
                                <th class="text-center">@lang('pet.description')</th>
                                <th class="text-center" width="100">@lang('sys.handle')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var table = $('#dt').on('draw.dt',function(e, settings){
                $('[data-toggle="tooltip"]').tooltip();
            })
            .DataTable({
                dom:"<'row'<'col-sm-12'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                pagingType: "full_numbers",
                pageLength: 10,
                autoWidth: false,
                processing: true,
                serverSide: true,
                lengthChange: true,
                searching: false,
                stateSave: true,
                ajax: {
                    type:'POST',
                    url: "{{URL::route('admin.pet.ajax',['_token'=>csrf_token()])}}"
                },
                columns: [
                    {data: 'pet_id',className:'text-center'},
                    {data: 'title'},
                    {
                        data: 'image',
                        className:'text-center',
                        render:function(data, type, row){
                            if(data)
                                data="<img src='"+data+"' height='120px' alt=''/>";
                            return data;
                        }
                    },
                    {
                        data: 'description',
                        orderable:false,
                        render:function(data, type, row){
                            data="<p style='margin-bottom:0;'>@lang('pet.title')："+row.title+"</p>";
                            data+="<p style='margin-bottom:0;'>@lang('pet.life')："+row.life+"</p>";
                            data+="<p style='margin-bottom:0;'>@lang('pet.money')："+row.money+"</p>";
                            data+="<p style='margin-bottom:0;'>@lang('pet.min_level')："+row.min_level+"</p>";
                            data+="<p style='margin-bottom:0;'>@lang('pet.buy_limit')："+row.buy_limit+"</p>";
                            data+="<p style='margin-bottom:0;'>@lang('pet.max_limit')："+row.max_limit+"</p>";
                            return data;
                        }
                    },
                    {
                        data: 'pet_id',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            data = "<a href='/admin/pet/edit/" + data + "' data-toggle='tooltip' data-placement='bottom' title='@lang('sys.edit')' style='padding:0 5px;'><i class='fa fa-edit'></i></a>"
                                    + "<a href='/admin/pet/del/" + data + "' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='@lang('sys.del')' style='padding:0 5px;'><i class='fa fa-remove'></i></a>";
                            return data;
                        }
                    }
                ],
                order: [[0, "desc"]]
            });
            $('#dt_length').append("<a class='btn btn-primary pull-right' href='{{URL::route('admin.pet.create')}}'>@lang('pet.create')</a>");
        });
    </script>
@endsection