@extends('admin.layouts.master')

@section('title', 'chỉnh sửa dự án')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Chỉnh sửa dự án</h1>
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
                                    <label for="title">Tên dự án <span class="required">(*)</span></label>
                                    <input type="text" name="project_name" id="project_name" class="form-control" value="{{ old('project_name', $project->project_name) }}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Mô tả</label>
                                    <textarea name="description" id="description">{{ old('description', $project->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ảnh hiển thị trên header</label>
                                    <input type="file" id="project_image_header" name="project_image_header" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_header_preview" src="{{ $project->project_image_header ? asset($project->project_image_header) : asset(config('custom.no_image')) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ảnh banner quảng cáo</label>
                                    <input type="file" id="project_image_ads" name="project_image_ads" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_ads_preview" src="{{ $project->project_image_ads ? asset($project->project_image_ads) : asset(config('custom.no_image')) }}" alt="">
                                        </div>
                                    </div>
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
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="is_current" id="is_current" value="1"{{ old('is_current', $project->is_current) ? ' checked="checked"' : '' }}> Đặt là dự án đang chạy</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1"><button type="submit" class="btn btn-primary">Lưu</button></div>
                                    <div class="col-md-1">
                                        <button style="@if($project->is_current)pointer-events:none; opacity: 0.6; @endif"
                                                class="btn btn-danger" id="btn-delete" data-link="{{ route('admin.project.destroy', $project->id) }}"><i class="fa fa-remove"></i> Xóa dự án</button></div>
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
@endsection

@section('inline_scripts')
    <script>
        $(function() {
            $("#project_image_header").change(function(){
                readURL(this, 'project_image_header_preview');
            });

            $("#project_image_ads").change(function(){
                readURL(this, 'project_image_ads_preview');
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