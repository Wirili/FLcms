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
                                <th class="text-center" width="40">@lang('sys.id')</th>
                                <th class="text-center" width="80">@lang('log1.label.name')</th>
                                <th class="text-center">@lang('log1.label.type')</th>
                                <th class="text-center">@lang('log1.label.price')</th>
                                <th class="text-center">@lang('log1.label.about')</th>
                                <th class="text-center">@lang('log1.label.ip')</th>
                                <th class="text-center" width="80">@lang('log1.label.add_time')</th>
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
            var table = $('#dt').on('draw.dt', function (e, settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }).DataTable({
                        dom: "<'row'<'col-sm-12'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                        pagingType: "full_numbers",
                        pageLength: 10,
                        autoWidth: false,
                        processing: true,
                        serverSide: true,
                        lengthChange: true,
                        searching: false,
                        stateSave: true,
                        ajax: {
                            type: 'POST',
                            url: "{{URL::route('admin.log1.ajax',['_token'=>csrf_token()])}}"
                        },
                        columns: [
                            {data: 'id', className: 'text-center'},
                            {data: 'user.name'},
                            {data: 'type'},
                            {data: 'price'},
                            {data: 'about'},
                            {data: 'ip'},
                            {data: 'add_time'},
                            {
                                data: 'id',
                                className: 'text-center',
                                orderable: false,
                                render: function (data, type, row) {
                                    data = "<a href='javascript:js_confirm(\"确认要删除激活日志？\",\"/admin/log1/del/" + data + "\")' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='@lang('sys.del')' style='padding:0 5px;'><i class='fa fa-remove'></i></a>";
                                    return data;
                                }
                            }
                        ],
                        order: [[0, "desc"]]
                    });
            $('#dt_length').append("<a class='btn btn-primary pull-right' href='{{URL::route('admin.log1.create')}}'>@lang('log1.create')</a>");
        });
    </script>
@endsection