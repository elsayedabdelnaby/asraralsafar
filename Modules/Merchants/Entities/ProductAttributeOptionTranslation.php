<?php

namespace Modules\Merchants\Entities;

use App\Traits\HasLanguage;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeOptionTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_attribute_option_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'product_attribute_option_id',
        'language_id'
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
     * return the related product attribute option
     */
    public function productAttributeOption(): BelongsTo
    {
        return $this->belongsTo(ProductAttributeOption::class, 'product_attribute_option_id');
    }
}
