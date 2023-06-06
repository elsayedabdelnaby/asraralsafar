<?php

namespace Modules\Website\Actions\FAQs;

use Modules\Website\Entities\FAQ;
use Modules\Website\Entities\FAQTranslation;
use Modules\Website\Http\Requests\FAQs\DeleteFAQRequest;

/**
 * handle delete a faq
 */
class DeleteFAQAction
{
    public function handle(DeleteFAQRequest $request): bool
    {
        // delete all translations of this faq
        FAQTranslation::where('faq_id', $request->id)->delete();
        // delete a faq
        $faq = FAQ::findOrFail($request->id);

        return $faq->delete();
    }
}
