<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\Post::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com'
        ]);
    }
}
