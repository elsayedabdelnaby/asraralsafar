<?php

namespace Modules\Settings\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueCategoryNameAndSlugPerType implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $category_type_id, private ?int $skipped_id = null)
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        foreach ($value as $translation) {
            $translation['language_id'];
            $query = DB::table('categories')->join('category_translations', 'categories.id', '=', 'category_translations.category_id');

            if ($this->category_type_id) {
                $query->where('categories.category_type_id', $this->category_type_id);
            } else {
                $query->whereNull('categories.category_type_id');
            }

            if ($this->skipped_id) {
                $query = $query->whereNot('categories.id', $this->skipped_id);
            }

            $exists = $query->where(function ($query) use ($translation) {
                return $query->orWhere('category_translations.name', $translation['name'])
                    ->orWhere('category_translations.slug', $translation['slug']);
            })->whereNull(['category_translations.deleted_at', 'categories.deleted_at'])->exists();

            if ($exists) {
                $fail(__('categories::main.the_category_name_or_slug_already_exist_on_the_same_type'));
            }
        }
    }
}
