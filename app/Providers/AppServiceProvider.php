<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Modules\Website\Actions\ContactInformations\GetAllActiveContactInformationsAction;
use Modules\Website\Actions\SocialLinks\GetAllActiveSocialLinksAction;
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
        $socialLinks = (new GetAllActiveSocialLinksAction)->handle()->orderBy('display_order')->get();
        $infoMail = (new GetAllActiveContactInformationsAction)->handle()->where('type', 'email')->first();
        $phoneNumber = (new GetAllActiveContactInformationsAction)->handle()->where('type', 'phone')->first();
        view()->share('footerSections', $footerSections);
        view()->share('socialLinks', $socialLinks);
        view()->share('infoMail', $infoMail);
        view()->share('phoneNumber', $phoneNumber);
    }
}
