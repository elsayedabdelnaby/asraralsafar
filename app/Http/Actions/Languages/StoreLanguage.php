<?php

namespace App\Http\Actions\Languages;

use App\Models\Language;
use App\Traits\FileUploadTrait;
use APP\HTTP\Requests\Languages\StoreLanguageRequest;
use Illuminate\Support\Facades\Cache;

/**
 * handle creating a new language
 */
class StoreLanguage
{
    use FileUploadTrait;

    public function handle(StoreLanguageRequest $request): Language
    {
        $icon = '';
        if ($request->hasFile('icon')) {
            $icon = $this->verifyAndUpload($request->file('icon')[0], $icon, 'public', 'settings/languages');
        }

        $language = new Language();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->direction = $request->direction;
        $language->icon = $icon;
        $language->is_active = $request->is_active === 'on';
        $language->save();

        Cache::forget('all_active_languages');

        return $language;
    }
}
