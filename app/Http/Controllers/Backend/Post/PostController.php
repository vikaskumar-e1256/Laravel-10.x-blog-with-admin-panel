<?php

namespace App\Http\Controllers\Backend\Post;

use DataTables;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Utilities\ImageHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;


class PostController extends Controller
{
    public function index()
    {
        return view('backend.posts.list');
    }

    public function create()
    {
        //$this->authorize('create');
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.posts.create', compact('categories', 'tags'));
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

    // -------------------------------------------------------------------------
    // Private and Protected Functions
    // -------------------------------------------------------------------------


    protected function getPostsData()
    {
        $posts = Post::with('image');

        return DataTables::of($posts)
            ->addColumn('image', function ($post) {
                return view('backend.posts.image_column', ['post' => $post])->render();
            })
            ->addColumn('status', function ($post) {
                return $post->status == 1 ? 'Approved' : 'Block';
            })
            ->addColumn('action', 'backend.posts.action_column')
            ->rawColumns(['body', 'image', 'status', 'action'])
            ->make(true);
    }

}
