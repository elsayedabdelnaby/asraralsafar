<?php

namespace Modules\UsersManagement\Providers;

use App\Models\User;
use Modules\UsersManagement\Entities\Role;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Observers\RoleObserver;
use Modules\UsersManagement\Observers\UserObserver;
use Modules\UsersManagement\Observers\ProfileObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Profile::class => [ProfileObserver::class],
        Role::class => [RoleObserver::class],
        User::class => [UserObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
