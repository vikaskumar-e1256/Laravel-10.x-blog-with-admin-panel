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

    public function created(Post $post)
    {
        $categoryIds = request()->input('categories', []);
        $tagIds = request()->input('tags', []);
        $post->categories()->sync($categoryIds);
        $post->tags()->sync($tagIds);
    }

    public function deleted(Post $post)
    {
        $post->categories()->detach();
        $post->tags()->detach();
    }
}
