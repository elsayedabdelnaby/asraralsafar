<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

/**
 * @purpose clear the cache attributes for the target id of the model
 */
class ClearCachedAttributes
{
    /**
     * @param int  $id record id
     * @param array $attributes
     */
    public static function clear(int $id, array $attributes)
    {
        foreach (getAllLanguages() as $language) :
            foreach ($attributes as $attribute) {
                Cache::forget($attribute . '_' . $id . '_' . $language->code);
            }
        endforeach;
    }
}
