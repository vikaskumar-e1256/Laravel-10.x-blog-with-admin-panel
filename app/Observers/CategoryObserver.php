<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "saving" event.
     */
    public function saving(Category $category)
    {

        $category->name = Str::ucfirst($category->name);
        $category->slug = Str::slug($category->slug);
    }
}
