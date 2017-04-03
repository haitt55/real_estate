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
                                        <th>Chỉnh sửa lần cuối</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td data-toggle="modal" data-target="#modalCustomer" style="cursor: pointer"><a href="javascript:void(0);">{{ $customer->full_name }}</a></td>
                                            <td>{{ $customer->project->project_name }}</td>
                                            <td>
                                                @if ($customer->is_new)
                                                    <span class="label label-success">mới</span>
                                                @else
                                                    <span class="label label-danger">đã liên hệ</span>
                                                @endif
                                            </td>
                                            <td>{{ $customer->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.project.edit', $customer->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
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
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
        });
    </script>
@endsection
