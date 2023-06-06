<?php

namespace App\Http\Actions\Languages;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LanguageResource;

/**
 * this action return all languages
 */
class GetAllLanguages
{
    public function handle()
    {
        $all_languages = Cache::rememberForever('all_languages', function () {
            return Language::all();
        });
        return LanguageResource::collection($all_languages);
    }
}
