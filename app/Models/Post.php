<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'body'
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * The categories that belong to the post.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the first image associated with the post.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
