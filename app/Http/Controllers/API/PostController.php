<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function getAllPosts()
    {
        // The method returns a paginated collection of posts that are marked as active.
        // Pagination is set to 3 posts per page to manage the data volume efficiently.

        // Laravel's Resource Collections are utilized here to transform and control
        // the structure of the API response. This is particularly useful for customizing
        // the API response format and adding any additional metadata if necessary.

        // It's important to note that directly using PostResource::collection
        // does not allow for the modification of the pagination response structure
        // such as the meta and links sections. If there's a need to customize the
        // pagination response or add additional top-level JSON structures,
        // a custom ResourceCollection class should be created.

        // This approach ensures that the API response adheres to best practices
        // for RESTful API design, providing clients with a predictable and
        // standardized format, including pagination details which are essential
        // for frontend components to navigate through large datasets.

        return PostResource::collection(Post::active()->paginate(3));
    }


    public function getPostBySlug($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return response()->json(['error' => 'no blog post found.'], 404);
        }
        return new PostResource($post);
    }
}
