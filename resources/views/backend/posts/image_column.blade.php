@if ($post->image && $post->image->filename)
    <img height="50px" width="50px" src="{{ asset('storage/images/' . $post->image->filename) }}">
@else
    <img src="{{ asset('path_to_empty_image.jpg') }}">
@endif
