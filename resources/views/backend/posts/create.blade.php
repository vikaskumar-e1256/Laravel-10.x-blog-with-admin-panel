@extends('backend.layouts.master')

@section('heading', 'Posts')
@section('page', 'Post')
@section('content')
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Create Post</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('admin.posts.store') }}" id="postForm" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subtitle" class="col-sm-2 control-label">Subtitle</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Subtitle">
                    </div>
                </div>

                <div class="form-group">
                    <label for="slug" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>
                </div>

                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">Body</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="body" name="body" placeholder="Body"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image" accept="image.*" placeholder="Image">
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <input type="checkbox" id="status" name="status" value="1"> Publish
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" id="submitForm" class="btn btn-info pull-right">Create Post</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('js/postForm.js') }}"></script>
@endpush
