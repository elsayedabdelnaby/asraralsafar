<?php

namespace Modules\Website\Actions\Testimonails;

use Modules\Website\Entities\Testimonail;

/**
 * handle get all testimonails condition
 */
class GetAllTestimonailsAction
{
    public function handle()
    {
        return Testimonail::currentLanguageTranslation('testimonails', 'testimonail_translations', 'testimonail_id');
    }
}
