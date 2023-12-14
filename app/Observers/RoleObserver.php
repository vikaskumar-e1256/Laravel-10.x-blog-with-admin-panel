<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver
{
    public function created(Role $role)
    {
        $permissionIds = request()->input('permissions', []);
        $role->permissions()->sync($permissionIds);
    }

    public function updated(Role $role)
    {
        $permissionIds = request()->input('permissions', []);
        $role->permissions()->sync($permissionIds);
    }

    public function deleted(Role $role)
    {
        $role->permissions()->detach();
    }
}
