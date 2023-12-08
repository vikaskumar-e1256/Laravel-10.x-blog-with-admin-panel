<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'slug', 'body'];

    /**
     * Get the first image associated with the post.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
