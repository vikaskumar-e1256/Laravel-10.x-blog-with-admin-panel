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
        $posts = Post::active()->with('categories', 'tags')->latest()->paginate($postsPerPage);
        return view('site.home', compact('posts'));
    }

    public function post(Post $slug)
    {
        $post = $slug->load(['categories', 'tags']);
        return view('site.post', ['post' => $post]);
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
}
