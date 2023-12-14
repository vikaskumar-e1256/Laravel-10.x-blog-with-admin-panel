<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            "Create-Post",
            "Update-Post",
            "Delete-Post",
            "Create-User",
            "Update-User",
            "Delete-User",
            "Create-Admin",
            "Update-Admin",
            "Delete-Admin",
            "Create-Category",
            "Update-Category",
            "Delete-Category",
            "Create-Tag",
            "Update-Tag",
            "Delete-Tag",
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                "name" => $permission,
            ]);
        }

    }
}
