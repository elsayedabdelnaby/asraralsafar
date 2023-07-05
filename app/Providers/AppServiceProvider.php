<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Modules\Website\Entities\FooterSection;
use Modules\Website\Entities\WebsiteInformation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading();
        Model::preventAccessingMissingAttributes();
        Schema::defaultStringLength(255);
        View::share('websiteInfo', WebsiteInformation::with('translations')->first());
        $footerSections = FooterSection::with('translations')->get();
        view()->share('footerSections', $footerSections);
    }
}
