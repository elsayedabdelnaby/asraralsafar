<?php

namespace App\Scopes;

trait CurrentLanguageTranslation
{

    /**
     * The translation model of the model.
     */
    protected $translationModel = self::class . 'Translation';

    /**
     * Scope a query to only include active records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $table the name of the table which need to get the translations of it
     * @param string $translations_table the name of the translations table
     * @param string $id the name of the id of the main model in the translation table
     * @return void
     */
    public function scopeCurrentLanguageTranslation($query, $table, $translations_table, $id)
    {
        return $query->leftJoin($translations_table, function ($query) use ($translations_table, $id, $table) {
            $query->on($translations_table . '.' . $id, '=', $table . '.id')
                ->where($translations_table . '.language_id', getCurrentLanguage()->id);
        });
    }

    /**
     * Get the translation of model to the current language else return the default translation of the default language
     */
    public function translation()
    {
        $translation = $this->hasOne($this->translationModel)->where('language_id', getCurrentLanguage()->id);
        return $translation->count() ? $translation : $this->hasOne($this->translationModel)->where('language_id', getMainLanguage()->id);
    }
}
