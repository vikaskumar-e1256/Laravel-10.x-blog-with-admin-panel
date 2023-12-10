@extends('backend.layouts.master')

@section('heading', 'Dashboard')
@section('description', 'Control panel')
@section('page', 'Dashboard')
@section('content')
    <div class="row">
        <!-- Box for Total Posts -->
        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $totalPosts }}</h3>

                    <p>Total Posts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.posts.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <!-- Box for Total Categories -->
        <div class="col-md-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $totalCategories }}</h3>

                    <p>Total Categories</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.categories.list') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Box for Total Users -->
        <div class="col-md-4">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>12650</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
@endpush
