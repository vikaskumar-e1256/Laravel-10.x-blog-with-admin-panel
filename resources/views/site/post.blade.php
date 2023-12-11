@extends('site.layouts.main')

@section('bg-img', asset('site_assets/img/post-bg.jpg'))
@section('title', $post->title)
@section('subheading', $post->subtitle)
@section('posted_by', 'Vk-Blog')
@section('post_create_datetime', $post->created_at->format('F j, Y'))

@section('content')
    <!-- Add section for displaying categories (if categories exist) -->
    @if ($post->categories->count() > 0)
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-categories">
                        <strong>Categories:</strong>
                        @foreach ($post->categories as $category)
                            <a href="{{ route('site.posts.category', $category->slug) }}" class="badge badge-primary">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </br>
    @endif
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </article>
    <!-- Add section for displaying related tags -->
    @if ($post->tags->count() > 0)
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-tags">
                        <strong>Tags:</strong>
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('site.posts.tag', $tag->slug) }}" class="badge badge-info">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Facebook comments plugin -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div id="fb-root"></div>
                <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId={{ env('FB_APP_ID') }}" nonce="VCDB23Sr">
    </script>
    <link href="{{ asset('site_assets') }}/css/prism.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('site_assets') }}/js/prism.js"></script>
@endpush
