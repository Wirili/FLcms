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
                                <th class="text-center" width="80">@lang('loguserlogin.label.name')</th>
                                <th class="text-center">@lang('loguserlogin.label.ip')</th>
                                <th class="text-center" width="80">@lang('loguserlogin.label.add_time')</th>
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
                            url: "{{URL::route('admin.loguserlogin.ajax',['_token'=>csrf_token()])}}"
                        },
                        columns: [
                            {data: 'id', className: 'text-center'},
                            {data: 'user.name'},
                            {data: 'ip'},
                            {data: 'add_time'},
                            {
                                data: 'id',
                                className: 'text-center',
                                orderable: false,
                                render: function (data, type, row) {
                                    data = "<a href='javascript:js_confirm(\"确认要删除日志？\",\"/admin/loguserlogin/del/" + data + "\")' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='@lang('sys.del')' style='padding:0 5px;'><i class='fa fa-remove'></i></a>";
                                    return data;
                                }
                            }
                        ],
                        order: [[0, "desc"]]
                    });
        });
    </script>
@endsection