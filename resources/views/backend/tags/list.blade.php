@extends('backend.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tags Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="tag-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@push('styles')
    <!-- Add DataTables Bootstrap styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')
<!-- Generate route URL and pass it to the JavaScript file -->
<script>
    const tagDataUrl = "{{ route('admin.tags.data') }}";
</script>
<!-- Include the JavaScript file -->
<script src="{{ asset('js/tags-datatable.js') }}"></script>

@endpush
