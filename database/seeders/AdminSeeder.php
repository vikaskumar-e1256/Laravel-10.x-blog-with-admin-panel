<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminsData = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '12345',
            ],
            [
                'name' => 'Writer',
                'email' => 'writer@writer.com',
                'password' => '12345',
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@editor.com',
                'password' => '12345',
            ],
        ];

        foreach ($adminsData as $adminData) {
            $admin = Admin::create(array_merge($adminData, [
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]));

            $roleName = Str::lower(str_replace(' ', '-', $adminData['name']));
            $roleIds = Role::where('name', $roleName)->pluck('id');
            $admin->roles()->sync($roleIds);
        }
    }
}
