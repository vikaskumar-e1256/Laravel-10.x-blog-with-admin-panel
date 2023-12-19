<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
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
    public function view(Admin $user, Category $category): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->hasPermission('create-category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Category $category): bool
    {
        return $user->hasPermission('update-category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Category $category): bool
    {
        return $user->hasPermission('delete-category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Category $category): bool
    {
        return false;
    }
}
