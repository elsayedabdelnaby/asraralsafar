<?php

namespace Modules\Merchants\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductVariantAttribute extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "product_variant_attributes";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_variant_id',
        'product_attribute_id',
        'product_attribute_option_id',
        'value'
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
     * return product Variant
     * @return BelongsTo
     */
    public function productVariant(): belongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    /**'
     * return Product Attribute
     * @return BelongsTo
     */
    public function productAttribute(): belongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }

    /**
     * return product attribute option
     * @return BelongsTo
     */
    public function productAttributeOption(): belongsTo
    {
        return $this->belongsTo(ProductAttributeOption::class, 'product_attribute_option_id');
    }
}
