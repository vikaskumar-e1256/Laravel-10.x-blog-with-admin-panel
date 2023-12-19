@extends("site.layouts.main")

@section('bg-img', asset('site_assets/img/home-bg.jpg'))
@section('title', 'Clean Blog')
@section('subheading', 'A Clean Blog Theme by Start Bootstrap')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @forelse ($posts as $post)
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
                <!-- Thumbs-up button -->
                @auth
                <i class="fa fa-fw fa-thumbs-o-up like-button" data-post-id="{{ $post->id }}" style="{{ $post->likes->contains('user_id', auth()->id()) ? 'color: red;' : '' }}"></i>
                @else
                <a href="{{ route('login') }}"><i class="fa fa-fw fa-thumbs-o-up like-button"></i></a>
                @endauth
            </div>
            <hr>
            @empty
            <div class="text-center">
                <p>No posts found.</p>
            </div>
            @endforelse

            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    {{ $posts->links() }}
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.like-button').on('click', function() {
            var postId = $(this).data('post-id');
            var url = '{{ route("site.post.like", ":id") }}';
            url = url.replace(':id', postId);
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.liked) {
                        $(".like-button[data-post-id='" + postId + "']").css('color', 'red');
                    } else {
                        $(".like-button[data-post-id='" + postId + "']").css('color', '');
                    }
                }
            });
        });
    });
</script>
@endpush
