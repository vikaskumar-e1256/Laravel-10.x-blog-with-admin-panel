<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagObserver
{
    /**
     * Handle the Tag "saving" event.
     */
    public function saving(Tag $tag)
    {
        $tag->name = Str::ucfirst($tag->name);
        $tag->slug = Str::slug($tag->slug);
    }
}
