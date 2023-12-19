<?php

namespace App\Http\Controllers\Site;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $postsPerPage = 25;
        $posts = Post::active()->with('categories', 'tags', 'likes')->latest()->paginate($postsPerPage);
        return view('site.home', compact('posts'));
    }

    public function post(Post $slug)
    {
        $post = $slug->load(['categories', 'tags']);
        return view('site.post', ['post' => $post]);
    }

    public function about()
    {
        return view('site.about');
    }

    public function contactUs()
    {
        return view('site.contact');
    }

    public function showByCategory(Category $slug)
    {
        $posts = $slug->posts()->latest()->paginate(25);
        return view('site.home', compact('posts'));
    }

    public function showByTag(Tag $slug)
    {
        $posts = $slug->posts()->latest()->paginate(25);
        return view('site.home', compact('posts'));
    }

    public function like($postId)
    {
        $post = Post::findOrFail($postId);
        $user = auth()->user();

        // Check if the user already liked the post
        if ($user->likes()->where('post_id', $post->id)->exists()) {
            $user->likes()->detach($post->id);
            $liked = false;
        } else {
            $user->likes()->attach($post->id);
            $liked = true;
        }

        return response()->json(['liked' => $liked]);
    }
}
