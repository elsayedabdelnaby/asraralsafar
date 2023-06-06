<?php

namespace Modules\Website\Enums;

enum PageName: string
{
    case Home           = 'home';
    case Checkout       = 'checkout';
    case Thanks         = 'thanks';
    case Login          = 'login';
    case PrivacyPolicy  = 'privacy_policy';
    case ContactUs      = 'contact_us';
    case Careers        = 'careers';
    case About          = 'about';
    case TermCondition  = 'terms_conditions';
    case TrackingOrder  = 'tracking_order';
    case Blogs          = 'blogs';
    case Products       = 'products';
    case Restaurants    = 'restaurants';
    case Grocery        = 'grocery';
    case Categories     = 'categories';
    case Offers         = 'offers';
}
