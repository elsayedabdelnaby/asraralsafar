<?php

namespace App\Traits;

use App\Models\Language;

trait HasLanguage
{
    /**
     * return the related langauge
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
