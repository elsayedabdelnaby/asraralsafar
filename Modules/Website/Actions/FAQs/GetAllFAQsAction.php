<?php

namespace Modules\Website\Actions\FAQs;

use Modules\Website\Entities\FAQ;

/**
 * handle get all faqs condition
 */
class GetAllFAQsAction
{
    public function handle()
    {
        $faqs = FAQ::currentLanguageTranslation('faqs', 'faq_translations', 'faq_id')
            ->withCategory('faqs.id');
        return $faqs;
    }
}
