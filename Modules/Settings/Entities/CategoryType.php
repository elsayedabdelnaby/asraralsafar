<?php

namespace Modules\Settings\Entities;

use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryType extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_types';

    /**
     * Return the name of the category type dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function typeName(): Attribute
    {
        $category = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('category_type_' . $this->id . '_' .  App::getLocale(), function () use ($category) {
                $category = $category->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $category ? $category->name : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(CategoryTypeTranslation::class, 'category_type_id');
    }

    /**
     * get all related categories
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'category_type_id');
    }
}
