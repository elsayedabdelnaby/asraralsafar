<?php

namespace Modules\Website\Actions\FAQs;

use Modules\Website\Entities\FAQ;
use Modules\Website\Entities\FAQTranslation;
use Modules\Website\Http\Requests\FAQs\UpdateFAQRequest;

/**
 * handle update a faq condition
 */
class UpdateFAQAction
{
    public function handle(UpdateFAQRequest $request): FAQ
    {
        $faq = FAQ::find($request->id);
        $faq->display_order = $request->display_order;
        $faq->is_active = $request->is_active ? true : false;
        $faq->save();

        $faq->categories()->sync($request->category_id, [
            'updated_at' => now()
        ]);

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            FAQTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'faq_id' => $faq->id
                ],
                [
                    'question' => $translation['question'],
                    'answer' => $translation['answer']
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($faq->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            FAQTranslation::where([
                ['language_id', '=', $language_id],
                ['faq_id', '=', $faq->id]
            ])->delete();
        }

        return $faq;
    }
}
