<?php

namespace Modules\Locations\Providers;

use Modules\Locations\Entities\City;
use Modules\Locations\Entities\State;
use Modules\Locations\Entities\Country;
use Modules\Locations\Observers\CityObserver;
use Modules\Locations\Observers\StateObserver;
use Modules\Locations\Observers\CountryObserver;
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
        Country::class => CountryObserver::class,
        State::class => StateObserver::class,
        City::class => CityObserver::class,
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
