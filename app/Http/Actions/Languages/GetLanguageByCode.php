<?php

namespace App\Http\Actions\Languages;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LanguageResource;

/**
 * return a specific language dependent on code
 */
class GetLanguageByCode
{
    public function handle($code): LanguageResource
    {
        $language = Cache::rememberForever('language_' . $code, function () use ($code) {
            return Language::where('code', $code)->first();
        });
        return new LanguageResource($language);
    }
}
