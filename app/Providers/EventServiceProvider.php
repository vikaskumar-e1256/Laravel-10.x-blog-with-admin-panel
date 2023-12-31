<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Category;
use App\Observers\TagObserver;
use App\Observers\PostObserver;
use App\Observers\RoleObserver;
use App\Observers\AdminObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Post::class => [PostObserver::class],
        Category::class => [CategoryObserver::class],
        Tag::class => [TagObserver::class],
        Admin::class => [AdminObserver::class],
        Role::class => [RoleObserver::class],
    ];

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
