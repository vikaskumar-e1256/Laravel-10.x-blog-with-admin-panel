<?php

namespace App\Observers;

use App\Models\Admin;

class AdminObserver
{
    public function creating(Admin $admin)
    {
        $admin->password = bcrypt($admin->password);
    }
    /**
     * Handle the Admin "created" event.
     */
    public function created(Admin $admin): void
    {
        $roleIds = request()->input('roles', []);
        $admin->roles()->sync($roleIds);
    }

    /**
     * Handle the Admin "updated" event.
     */
    public function updated(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "deleted" event.
     */
    public function deleted(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "restored" event.
     */
    public function restored(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "force deleted" event.
     */
    public function forceDeleted(Admin $admin): void
    {
        //
    }
}
