<?php

namespace App\Http\Actions\Languages;

use App\Http\Requests\Languages\UpdateLanguageRequest;
use App\Models\Language;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Cache;

/**
 * handle updateing the language
 */
class UpdateLanguage
{
    use FileUploadTrait;

    /**
     * @throws \Throwable
     */
    public function handle(UpdateLanguageRequest $request)
    {
        $language = Language::whereId($request->id)
            ->where('id', '>', 2)
            ->active()
            ->first();

        throw_if(is_null($language), new \Exception('This language does not exist or can not be edited'));

        $icon = $language->icon ? $language->icon : '';
        if ($request->hasFile('icon')) {
            $icon = $this->verifyAndUpload($request->file('icon')[0], $icon, 'public', 'generalsettings/languages');
        }

        $language->update([
            'name' => $request->name,
            'code' => $request->code,
            'direction' => $request->direction,
            'icon' => $request->icon ?? '',
            'is_active' => $request->is_active === 'on'
        ]);

        Cache::forget('all_active_languages');
    }
}
