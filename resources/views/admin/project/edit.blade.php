@extends('admin.layouts.master')

@section('title', 'chỉnh sửa dự án')
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
            <h1 class="page-header">Chỉnh sửa sản phẩm</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.project.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Danh sách dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('admin.project.update', $project->id) }}" role="form" enctype="multipart/form-data">
                                @include('admin.layouts.partials.errors')
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}
                                <div class="form-group">
                                    <label for="project_name">Tên sản phẩm <span class="required">(*)</span></label>
                                    <input type="text" name="project_name" id="project_name" class="form-control" value="{{ old('project_name', $project->project_name) }}">
                                </div>
                                <div class="form-group">{{ Form::label('main_project_id', 'Dự án') }}
                                    {{ Form::select('main_project_id', $mainProjects, $project->main_project_id, ['class' =>
                                    'form-control']) }}</div>
                                <div class="form-group">
                                    <label for="image">Ảnh banner quảng cáo 1</label>
                                    <input type="file" id="project_image_ads" name="project_image_ads" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_ads_preview" src="{{ $project->project_image_ads ? asset($project->project_image_ads) : asset(config('custom.no_image')) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ảnh banner quảng cáo 2</label>
                                    <input type="file" id="project_image_ads1" name="project_image_ads1" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_ads1_preview" src="{{ $project->project_image_ads1 ? asset($project->project_image_ads1) : asset(config('custom.no_image')) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="width: 100%" for="content">Nội dung </label>
                                    <textarea name="description" id="description">{{ old('description', $project->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="page_title">Page Title</label>
                                    <input type="text" name="page_title" id="page_title" class="form-control" value="{{ old('page_title', $project->page_title) }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{ old('meta_keyword', $project->meta_keyword) }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ old('meta_description', $project->meta_description) }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1"><button type="submit" class="btn btn-primary">Lưu</button></div>
                                    <div class="col-md-1">
                                        <button style="@if($project->is_current)pointer-events:none; opacity: 0.6; @endif"
                                                class="btn btn-danger" id="btn-delete" data-link="{{ route('admin.project.destroy', $project->id) }}"><i class="fa fa-remove"></i> Xóa sản phẩm</button></div>
                                </div>
                            </form>
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
                    <h4 class="modal-title" id="myModalLabel">Kho ảnh dự án</h4>
                </div>
                <div class="modal-body">
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
                                            <td>
                                                {{ $image->title }}
                                            </td>
                                            <td>
                                                <img class="thumbnail" style="max-width: 200px; max-height: 200px;" id="project_image_header_preview" src="{{ $image->image ? asset($image->image) : asset(config('custom.no_image')) }}" alt="">
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-copy" data-clipboard-text={{ asset($image->image) }}><i class="fa fa-copy"></i> Copy link ảnh</button>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('inline_scripts')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script src="/templates/admin/sbadmin2/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('js/clipboard.js/dist/clipboard.js')}}"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <script>
        var clipboard = new Clipboard('.btn-copy', {
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

            $("#project_image_logo").change(function(){
                readURL(this, 'project_image_logo_preview');
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-delete").click(function() {
                if (confirm('Do you really want to delete this data?')) {
                    var url = $(this).attr('data-link');
                    $.ajax({
                        url : url,
                        type : 'DELETE',
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf_token"]').attr('content');
                            if (token) {
                                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            }
                        },
                        success: function(data) {
                            if (data.error) {
                                window.location.href = '{{ URL::route('admin.project.edit', $project->id) }}';
                            } else {
                                window.location.href = '{{ URL::route('admin.project.index') }}';
                            }
                        },
                        error: function(data) {
                            window.location.href = '{{ URL::route('admin.project.index') }}';
                        }
                    });
                }
            });
        });
    </script>
@endsection