<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            "Create-Post" => "post",
            "Update-Post" => "post",
            "Delete-Post" => "post",
            "Create-User" => "user",
            "Update-User" => "user",
            "Delete-User" => "user",
            "Create-Admin" => "admin",
            "Update-Admin" => "admin",
            "Delete-Admin" => "admin",
            "Create-Category" => "category",
            "Update-Category" => "category",
            "Delete-Category" => "category",
            "Create-Tag" => "tag",
            "Update-Tag" => "tag",
            "Delete-Tag" => "tag",
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create([
                "name" => Str::lower($key),
                "for" => Str::lower($permission),
            ]);
        }

    }
}
