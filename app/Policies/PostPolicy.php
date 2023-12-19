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
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        //$user->roles()
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Post $post): bool
    {
        //
    }
}
