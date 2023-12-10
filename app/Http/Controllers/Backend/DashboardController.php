<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $totalPosts = Post::count();
        $totalCategories = Category::count();

        // Posts per date
        $postsPerDate = Post::selectRaw('DATE(created_at) as date, count(*) as count')
        ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('backend.dashboard', compact('totalPosts', 'totalCategories', 'postsPerDate'));
    }
}
