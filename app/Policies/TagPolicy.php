<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Tag;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Tag $tag): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->hasPermission('create-tag');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Tag $tag): bool
    {
        return $user->hasPermission('update-tag');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Tag $tag): bool
    {
        return $user->hasPermission('delete-tag');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Tag $tag): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Tag $tag): bool
    {
        return false;
    }
}
