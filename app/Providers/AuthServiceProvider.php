<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Admin;
use App\Models\Category;
use App\Policies\TagPolicy;
use App\Policies\PostPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('crud-roles', function (Admin $user) {
            return $user->roles->contains('name', 'admin');
        });

        Gate::define('crud-permission', function (Admin $user) {
            return $user->roles->contains('name', 'admin');
        });

        Gate::define('crud-admin', function (Admin $user) {
            return $user->roles->contains('name', 'admin');
        });

    }
}
