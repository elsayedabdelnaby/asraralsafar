<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Website\Entities\FooterSection;
use Modules\Website\Entities\WebsiteInformation;
use Modules\Website\Actions\Services\GetAllActiveServicesAction;
use Modules\Website\Actions\SocialLinks\GetAllActiveSocialLinksAction;
use Modules\Website\Actions\ContactInformations\GetAllActiveContactInformationsAction;

class WebsiteFrontEnd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        View::share('websiteInfo', WebsiteInformation::with('translations')->first());
        $footerSections = FooterSection::with('translations')->get();
        $socialLinks = (new GetAllActiveSocialLinksAction)->handle()->orderBy('display_order')->get();
        $infoMail = (new GetAllActiveContactInformationsAction)->handle()->where('type', 'email')->first();
        $phoneNumbers = (new GetAllActiveContactInformationsAction)->handle()->where('type', 'phone')->get();
        $whatsApp = (new GetAllActiveContactInformationsAction)->handle()->where('type', 'whatsapp')->first();
        $services = (new GetAllActiveServicesAction)->handle()->select(['services.id', 'name', 'slug', 'image'])->orderBy('display_order')->get();
        view()->share('footerSections', $footerSections);
        view()->share('socialLinks', $socialLinks);
        view()->share('infoMail', $infoMail);
        view()->share('phoneNumbers', $phoneNumbers);
        view()->share('whatsApp', $whatsApp);
        view()->share('services', $services);

        return $next($request);
    }
}
