<?php

namespace Modules\Website\Actions\Testimonails;

use Modules\Website\Entities\Testimonail;

/**
 * handle get all active Testimonails
 */
class GetAllActiveTestimonailsAction
{
    public function handle()
    {
        $testimonails = Testimonail::currentLanguageTranslation('testimonails', 'Testimonail_translations', 'testimonail_id')
            ->active();
        return $testimonails;
    }
}
