@extends('admin.layouts.master')

@section('title', 'Settings')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Settings</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Settings
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('admin.appSettings.updateGeneral') }}" role="form">
                                @include('admin.layouts.partials.errors')
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}
                                <div class="form-group">
                                    <label for="company">Tên công ty</label>
                                    <input type="company" name="company" id="company" class="form-control" value="{{ old('company', $appSettings['company']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $appSettings['email']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="whole_phone">Di động</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $appSettings['phone']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="whole_phone">Di động 2</label>
                                    <input type="text" name="phone2" id="phone2" class="form-control" value="{{ old('phone2', $appSettings['phone2']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $appSettings['address']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="page_title">Cam kết bán hàng</label>
                                    <textarea name="commitment" id="commitment" class="form-control">{{ old('commitment', $appSettings['commitment']) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="page_title">Page Title</label>
                                    <input type="text" name="page_title" id="page_title" class="form-control" value="{{ old('page_title', $appSettings['page_title']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{ old('meta_keyword', $appSettings['meta_keyword']) }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ old('meta_description', $appSettings['meta_description']) }}">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
    @parent
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'commitment' );
    </script>
@endsection
