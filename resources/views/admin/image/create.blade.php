@extends('admin.layouts.master')

@section('title', 'thêm dự án mới')

@section('css')
    @parent

    <!-- DataTables CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="http://www.dropzonejs.com/css/dropzone.css?v=1473248119">
@endsection
@section('content')
    <style>
        #dropzone { margin-bottom: 3rem; }
        .dropzone { border: 2px dashed #0087F7; border-radius: 5px; background: white; }
        .dropzone .dz-message { font-weight: 400; }
        .dropzone .dz-message .note { font-size: 1em; font-weight: 200; display: block; margin-top: 1.4rem; }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Kho ảnh - {{ $project->project_name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.image.index') }}?project_id=" class="btn btn-success"><i class="fa fa-list"></i> Xem kho ảnh tất cả dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-customers">
                                    <thead>
                                    <tr>
                                        <th>Tiêu đề ảnh</th>
                                        <th>Ảnh</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td data-title="{{$image->title}}"
                                                data-image="{{$image->image}}"
                                                data-toggle="modal" data-target="#modalCustomer" style="cursor: pointer">
                                                <a href="javascript:void(0);">{{ $image->title }}</a>
                                            </td>
                                            <td>
                                                <img class="thumbnail" style="max-width: 200px; max-height: 200px;" id="project_image_header_preview" src="{{ $image->image ? asset($image->image) : asset(config('custom.no_image')) }}" alt="">
                                            </td>
                                            <td>
                                                <button class="btn btn-info" data-clipboard-text={{ asset($image->image) }}><i class="fa fa-copy"></i> Copy link ảnh</button>
                                                <a href="" class="btn btn-danger"><i class="fa fa-remove"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Thêm ảnh</h3>
                        </div>
                        <div class="col-lg-12">
                            <div id="dropzone" style="border: #2980b9">
                                <form action="{{ route('admin.image.store') }}" class="dropzone needsclick dz-clickable" id="demo-upload">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <div class="dz-message needsclick">
                                        Kéo thả ảnh vào đây để upload.<br>
                                        <span class="note needsclick">(một hoặc nhiều ảnh.)</span>
                                    </div>
                                </form>
                            </div>
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
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/clipboard.js/dist/clipboard.js')}}"></script>

@endsection
@section('inline_scripts')
    <script>
        var clipboard = new Clipboard('.btn-info', {
            text: function(trigger) {
                return trigger.getAttribute('data-clipboard-text');
            }
        });

        $('button').tooltip({
            trigger: 'click',
            placement: 'bottom'
        });

        function setTooltip(btn, message) {
            $(btn).tooltip('hide')
                .attr('data-original-title', message)
                .tooltip('show');
        }

        function hideTooltip(btn) {
            setTimeout(function () {
                $(btn).tooltip('hide');
            }, 1000);
        }

        clipboard.on('success', function(e) {
            setTooltip(e.trigger, 'Copied!');
            hideTooltip(e.trigger);
        });

        clipboard.on('error', function(e) {
            setTooltip(e.trigger, 'Failed!');
            hideTooltip(e.trigger);
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#dataTables-customers").DataTable({
                responsive: true,
                "order": [[ 2, "asc" ]],
                "aoColumns": [
                    null, null,
                    { bSortable: false }
                ]
            });
        });
        $(function() {
            $("#project_image_header").change(function(){
                readURL(this, 'project_image_header_preview');
            });

            $("#project_image_ads").change(function(){
                readURL(this, 'project_image_ads_preview');
            });

            $("#project_image_ads1").change(function(){
                readURL(this, 'project_image_ads1_preview');
            });
        });
        function readURL(input, targetID) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + targetID).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection