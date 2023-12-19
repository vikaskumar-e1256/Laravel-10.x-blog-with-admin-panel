<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Support\Str;

class RoleObserver
{
    public function saving(Role $role)
    {
        $role->name = Str::lower($role->name);
    }

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
