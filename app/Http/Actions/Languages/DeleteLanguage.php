<?php

namespace App\Http\Actions\Languages;

use App\Models\Language;
use App\Services\DeleteFile;
use App\Http\Requests\Languages\DeleteLanguageReqeust;

/**
 * handle delete a language
 */
class DeleteLanguage
{

    public function handle(DeleteLanguageReqeust $request): bool
    {
        $language = Language::findOrFail($request->id);
        DeleteFile::delete($language->icon, 'generalsettings/languages', 'public');
        return $language->delete();
    }
}
