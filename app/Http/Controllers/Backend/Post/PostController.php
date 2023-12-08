<?php

namespace App\Http\Controllers\Backend\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Utilities\ImageHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('backend.posts.list');
    }

    public function create()
    {
        return view('backend.posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        // Create a new post
        $post = new Post;
        $post->fill($request->only(['title', 'subtitle', 'slug', 'body']));
        $post->status = $request->input('status', false);
        $post->posted_by = Auth::id() ?? 0;
        // Save the post
        $post->save();

        // Handle image upload with morph relationship and additional data
        $uploadedFile = $request->file('image');

        if ($uploadedFile) {
            $additionalData = $request->only(['alt_text', 'caption', 'description', 'order', 'is_visible', 'uploaded_by']);
            ImageHandler::uploadImages($uploadedFile, 'images', $post->id, Post::class, $additionalData);
        }

        // Return a success response
        return response()->json(['message' => 'Post created successfully'], 200);
    }

}
