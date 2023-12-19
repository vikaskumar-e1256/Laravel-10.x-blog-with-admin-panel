<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionaToRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            $permissions = [];

            if ($role->name === "admin") {
                $permissions = Permission::all();
            } elseif ($role->name === "writer") {
                $permissions = Permission::whereIn('name', ['create-post', 'create-category', 'create-tag'])->get();
            } elseif ($role->name === "editor") {
                $permissions = Permission::whereIn('name', ['update-post', 'update-category', 'update-tag', 'delete-post', 'delete-category', 'delete-tag'])->get();
            }

            $role->permissions()->sync($permissions->pluck('id'));
        }
    }
}
