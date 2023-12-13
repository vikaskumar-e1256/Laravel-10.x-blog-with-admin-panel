@extends('backend.layouts.master')

@section('heading', 'Create Admin and Assign Roles')
@section('page', 'Admin')

@section('content')
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Create Admin and Assign Roles</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('admins.store') }}" id="userForm" class="form-horizontal">
            @csrf

            <div class="box-body">
                <!-- User Information -->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>

                <!-- Roles -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Roles</label>
                    <div class="col-sm-10">
                        @foreach ($roles as $role)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" id="submitForm" class="btn btn-info pull-right">Create User</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('js/adminForm.js') }}"></script>
@endpush
