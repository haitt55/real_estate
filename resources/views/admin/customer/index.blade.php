@extends('admin.layouts.master')
@section('title', 'Khách hàng')

@section('css')
    @parent

    <!-- DataTables CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@endsection
@section('content')
    @if(session('message'))
        <div class="alert alert-success" style="margin-top: 10px; margin-bottom: 0px;">
            <ul>
                <li>{{session('message')}}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách khách hàng</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <br />
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" action="{{ route('admin.customer.index') }}" method="GET">
                <div class="form-group">
                    <label for="project_id">Lọc theo dự án:</label>
                    <select class="form-control" name="project_id" id="project_id">
                        <option value="">Tất cả các dự án</option>
                        @foreach($projectOptions as $key => $value)
                            <option value="{{ $key }}" @if($key == $chosenProject)selected="selected"@endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search">&nbsp;</span>Lọc</button>
            </form>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Customer List
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-customers">
                                    <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Tên dự án</th>
                                        <th>Trạng thái</th>
                                        <th>Gửi tới lúc</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td data-email="{{$customer->email}}"
                                                data-full_name="{{$customer->full_name}}"
                                                data-phone_number="{{$customer->phone_number}}"
                                                data-message="{{$customer->message}}"
                                                data-created_at="{{$customer->created_at}}"
                                                data-toggle="modal" data-target="#modalCustomer" style="cursor: pointer">
                                                <a href="javascript:void(0);">{{ $customer->full_name }}</a>
                                            </td>
                                            <td>{{ $customer->project ? $customer->project->project_name : '' }}</td>
                                            <td>
                                                @if ($customer->is_new)
                                                    <span class="label label-success">mới</span>
                                                @else
                                                    <span class="label label-danger">đã liên hệ</span>
                                                @endif
                                            </td>
                                            <td>{{ $customer->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.project.edit', $customer->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                                                <button class="btn change-status-button @if($customer->is_new) btn-danger @else btn-success @endif" id="change-status-{{ $customer->id }}">
                                                    @if ($customer->is_new)
                                                        Đã liên hệ
                                                    @else
                                                        Mới
                                                    @endif
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="modal fade" id="modalCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Thông tin khách hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            Tên khách hàng
                        </div>
                        <div class="col-md-9" id="md-full_name">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            Email
                        </div>
                        <div class="col-md-9" id="md-email">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            Số điện thoại
                        </div>
                        <div class="col-md-9" id="md-phone_number">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            Tin nhắn
                        </div>
                        <div class="col-md-9" id="md-message">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            Gửi tới lúc
                        </div>
                        <div class="col-md-9" id="md-created_at">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('javascript')
    @parent

    <!-- DataTables JavaScript -->
    <script src="/templates/admin/sbadmin2/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#dataTables-customers").DataTable({
                responsive: true,
                "order": [[ 2, "asc" ]],
                "aoColumns": [
                    null, null, null, null,
                    { bSortable: false }
                ]
            });

            $('#modalCustomer').on('show.bs.modal', function (e) {
                var button = e.relatedTarget;
                $('#md-full_name').text($(button).attr('data-full_name'));
                $('#md-email').text($(button).attr('data-email'));
                $('#md-phone_number').text($(button).attr('data-phone_number'));
                $('#md-message').text($(button).attr('data-message'));
                $('#md-created_at').text($(button).attr('data-created_at'));
            });

            $('.change-status-button').click(function () {

            });
        });
    </script>
@endsection
