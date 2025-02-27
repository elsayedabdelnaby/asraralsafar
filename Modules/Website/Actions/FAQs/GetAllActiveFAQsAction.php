<?php

namespace Modules\Website\Actions\FAQs;

use Modules\Website\Entities\FAQ;

/**
 * handle get all active faqs
 */
class GetAllActiveFAQsAction
{
    public function handle()
    {
        $faqs = FAQ::currentLanguageTranslation('faqs', 'faq_translations', 'faq_id')
            ->active();
        return $faqs;
    }
}
