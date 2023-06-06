<?php

namespace Modules\Website\Actions\FAQs;

use Modules\Website\Entities\FAQ;
use Modules\Website\Http\Requests\FAQs\ToggleFAQRequest;

/**
 * @purpose toggle the faq status
 */
class ToggleFAQAction
{
    /**
     * @param ToggleFAQRequest $request
     */
    public function handle(ToggleFAQRequest $request): bool
    {
        $faq = FAQ::find($request->id);
        $faq->is_active = !$faq->is_active;
        return $faq->save();
    }
}
