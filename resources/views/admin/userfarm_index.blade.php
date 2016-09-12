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
                                <th class="text-center" width="80">@lang('userfarm.name')</th>
                                <th class="text-center">@lang('userfarm.title')</th>
                                <th class="text-center" width="80">@lang('userfarm.add_time')</th>
                                <th class="text-center" width="80">@lang('userfarm.end_time')</th>
                                <th class="text-center" width="80">@lang('userfarm.settle_time')</th>
                                <th class="text-center" width="80">@lang('userfarm.settle_len')</th>
                                <th class="text-center" width="80">@lang('userfarm.is_end')</th>
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
                            url: "{{URL::route('admin.userfarm.ajax',['_token'=>csrf_token()])}}"
                        },
                        columns: [
                            {data: 'id', className: 'text-center'},
                            {data: 'user.name'},
                            {data: 'title'},
                            {data: 'add_time'},
                            {data: 'end_time'},
                            {data: 'settle_time'},
                            {
                                data: 'settle_len',
                                className: 'text-center',
                                render: function (data, type, row) {
                                    return data + '/' + row.life;
                                }
                            },
                            {
                                data: 'is_end',
                                className: 'text-center',
                                render: function (data, type, row) {
                                    if (data == 1) {
                                        data = "<i class='fa fa-check text-success'></i>";
                                    } else {
                                        data = "<i class='fa fa-remove text-danger'></i>"
                                    }
                                    return data;
                                }
                            },
                            {
                                data: 'id',
                                className: 'text-center',
                                orderable: false,
                                render: function (data, type, row) {
                                    data = "<a href='javascript:js_confirm(\"确认要结算该会员的乐园宠物产币数据吗？\",\"/admin/userfarm/edit/" + data + "\")' data-toggle='tooltip' data-placement='bottom' title='@lang('sys.settle')' style='padding:0 5px;'><i class='fa fa-edit'></i></a>"
                                            + "<a href='javascript:js_confirm(\"确认要删除会员宠物？\",\"/admin/userfarm/del/" + data + "\")' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='@lang('sys.del')' style='padding:0 5px;'><i class='fa fa-remove'></i></a>";
                                    return data;
                                }
                            }
                        ],
                        order: [[0, "desc"]]
                    });
        });
    </script>
@endsection