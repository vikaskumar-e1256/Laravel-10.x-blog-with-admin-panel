<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $postsPerPage = 25;
        $activePosts = Post::active()->latest()->paginate($postsPerPage);
        return view('site.home', compact('activePosts'));
    }

    public function post(Post $slug)
    {
        return view('site.post', ['post' => $slug]);
    }
}
