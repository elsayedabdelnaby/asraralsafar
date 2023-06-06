<?php

namespace App\Http\Actions\Languages;

use App\Models\Language;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LanguageResource;

/**
 * this action return all languages
 */
class GetAllActiveLanguages
{
    public function handle(): AnonymousResourceCollection
    {
        $all_active_lanuages = Cache::rememberForever('all_active_languages', function () {
            return Language::active()->get();
        });
        return LanguageResource::collection($all_active_lanuages);
    }
}
