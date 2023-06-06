<?php

namespace Modules\Settings\Providers;

use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\Currency;
use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Observers\CategoryObserver;
use Modules\Settings\Observers\CurrencyObserver;
use Modules\Settings\Observers\CategoryTypeObserver;
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
        CategoryType::class => [CategoryTypeObserver::class],
        Category::class => [CategoryObserver::class],
        Currency::class => [CurrencyObserver::class],
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
