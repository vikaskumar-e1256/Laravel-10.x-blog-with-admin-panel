@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Clean Blog')
@section('subheading', 'A Clean Blog Theme by Start Bootstrap')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @forelse ($activePosts as $post)
            <div class="post-preview">
                <a href="{{ route('site.post', $post->slug) }}">
                    <h2 class="post-title">
                        {{ $post->title }}
                    </h2>
                    <h3 class="post-subtitle">
                        {{ $post->subtitle }}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on {{ $post->created_at->format('F j, Y') }}</p>
            </div>
            <hr>
            @empty

            @endforelse

            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    {{ $activePosts->links() }}
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
