<?php

namespace Modules\Website\Providers;

use Modules\Website\Entities\FAQ;
use Modules\Website\Entities\Blog;
use Modules\Website\Entities\AboutUs;
use Modules\Website\Entities\MetaPage;
use Modules\Website\Entities\FooterLink;
use Modules\Website\Observers\FAQObserver;
use Modules\Website\Entities\FooterSection;
use Modules\Website\Entities\PrivacyPolicy;
use Modules\Website\Entities\TermCondition;
use Modules\Website\Observers\BlogObserver;
use Modules\Website\Observers\AboutUsObserver;
use Modules\Website\Observers\MetaPageObserver;
use Modules\Website\Entities\WebsiteInformation;
use Modules\Website\Observers\FooterLinkObserver;
use Modules\Website\Observers\FooterSectionObserver;
use Modules\Website\Observers\PrivacyPolicyObserver;
use Modules\Website\Observers\TermConditionObserver;
use Modules\Website\Observers\WebsiteInformationObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Website\Entities\Testimonail;
use Modules\Website\Observers\TestimonailObserver;

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
        WebsiteInformation::class => [WebsiteInformationObserver::class],
        FooterSection::class => [FooterSectionObserver::class],
        FooterLink::class => [FooterLinkObserver::class],
        PrivacyPolicy::class => [PrivacyPolicyObserver::class],
        MetaPage::class => [MetaPageObserver::class],
        TermCondition::class => [TermConditionObserver::class],
        FAQ::class => [FAQObserver::class],
        Blog::class => [BlogObserver::class],
        AboutUs::class => [AboutUsObserver::class],
        Testimonail::class => [TestimonailObserver::class],
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
