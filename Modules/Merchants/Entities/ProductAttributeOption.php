<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeOption extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "product_attribute_options";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_attribute_id',
        'is_active',
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
        return $this->hasMany(ProductAttributeOptionTranslation::class, 'product_attribute_option_id');
    }
}
