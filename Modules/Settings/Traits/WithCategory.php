<?php

namespace Modules\Settings\Traits;

trait WithCategory
{
    /**
     * Scope a query to only include active records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $column_name the column of the category id in the relation table
     * @return void
     */
    public function scopeWithCategory($query, $column_name)
    {
        return $query->leftJoin("categorizables", "categorizables.categorizable_id", "=", $column_name)
            ->leftJoin('categories', 'categories.id', '=', "categorizables.category_id")
            ->leftJoin('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->whereNull(['categories.deleted_at', 'category_translations.deleted_at']);
    }
}
