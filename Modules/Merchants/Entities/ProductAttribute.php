<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Category;
use Modules\Settings\Traits\WithCategory;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, WithCategory, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "product_attributes";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'is_active',
        'input_type',
    ];

    /**
     * log any activity on the current model
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty();
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ProductAttributeTranslation::class, 'product_attribute_id');
    }

    /**
     * get all options of the product attribute
     */
    public function options(): HasMany
    {
        return $this->hasMany(ProductAttributeOption::class, 'product_attribute_id');
    }

    /**
     * Get the blog's category.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
