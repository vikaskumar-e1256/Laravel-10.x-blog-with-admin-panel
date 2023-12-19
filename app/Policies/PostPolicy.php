<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return true; // All users can view any post
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Post $post): bool
    {
        return true; // All users can view a specific post
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        // Check if the user has the 'create-post' permission
        return $user->hasPermission('create-post');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Post $post): bool
    {
        // Check if the user has the 'update-post' permission
        return $user->hasPermission('update-post');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Post $post): bool
    {
        // Check if the user has the 'delete-post' permission
        return $user->hasPermission('delete-post');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Post $post): bool
    {
        // You can customize this based on your business logic
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Post $post): bool
    {
        // You can customize this based on your business logic
        return false;
    }
}
