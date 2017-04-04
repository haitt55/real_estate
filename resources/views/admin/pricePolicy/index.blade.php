@extends('admin.layouts.master')

@section('title', 'Bảng giá và Chính sách')

@section('css')
    @parent

    <!-- DataTables CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dự án - Bảng giá và Chính sách</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="/admin/pricePolicy/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm Bảng giá và Chính sách cho dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bảng giá và Chính sách
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-pricePolicyList">
                                    <thead>
                                    <tr>
                                        <th>Tên Bảng giá và Chính sách</th>
                                        <th>Tên dự án</th>
                                        <th>Chỉnh sửa lần cuối</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pricePolicyList as $pricePolicy)
                                        <tr>
                                            <td><a href="/admin/pricePolicy/{{ $pricePolicy->id }}">{{ $pricePolicy->title }}</a></td>
                                            <td>{{ $pricePolicy->project_name }}</td>
                                            <td>{{ $pricePolicy->updated_at }}</td>
                                            <td>
                                                <a href="/admin/pricePolicy/{{ $pricePolicy->id }}/edit" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
<!--                                                  {{ Form::open(array('url' => 'admin/pricePolicy/' . $pricePolicy->id, 'class' => 'pull-right')) }} -->
<!-- 								                    {{ Form::hidden('_method', 'DELETE') }} -->
<!-- 								                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }} -->
<!-- 								                {{ Form::close() }} -->
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
            $("#dataTables-pricePolicyList").DataTable({
                responsive: true,
                "order": [[ 1, "desc" ]],
                "aoColumns": [
                    null, null,
                    { bSortable: false }
                ]
            });
        });
    </script>
@endsection