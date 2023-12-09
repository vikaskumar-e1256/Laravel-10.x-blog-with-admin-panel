<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Post "saving" event.
     */
    public function saving(Post $post)
    {
        $post->slug = Str::slug($post->slug);
    }
}
