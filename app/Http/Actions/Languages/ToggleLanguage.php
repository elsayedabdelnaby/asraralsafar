<?php

namespace App\Http\Actions\Languages;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * @purpose toggle the Currency status
 */
class ToggleLanguage
{
    /**
     * @param Request $request
     * return boolean
     * @return bool
     */
    public function handle(Request $request): bool
    {
        throw_if(in_array($request->id, [1, 2]),
            new \Exception(__('dashboard.can_not_deactivate_this_language')));

        $language = Language::find($request->id);

        $language->is_active = !$language->is_active;

        Cache::forget('all_active_languages');

        return $language->save();
    }
}
