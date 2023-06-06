<?php

namespace Modules\Website\Actions\FAQs;

use Modules\Website\Entities\FAQ;
use Modules\Website\Entities\FAQTranslation;
use Modules\Website\Http\Requests\FAQs\StoreFAQRequest;

/**
 * handle create a faq
 */
class StoreFAQAction
{
    public function handle(StoreFAQRequest $request): FAQ
    {
        $faq = new FAQ();
        $faq->is_active = $request->is_active ? true : false;
        $faq->display_order = $request->display_order ? $request->display_order : 0;
        $faq->save();

        $faq->categories()->attach($request->category_id, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'question' => $translation['question'],
                'answer' => $translation['answer'],
                'language_id' => $translation['language_id'],
                'faq_id' => $faq->id,
            ];

            FAQTranslation::create($translation_data);
        }

        return $faq;
    }
}
