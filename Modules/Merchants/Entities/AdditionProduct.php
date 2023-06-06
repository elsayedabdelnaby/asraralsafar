<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Category;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdditionProduct extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "additions_products";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_type_id',
        'merchant_id',
        'price',
        'discount_price',
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
     * Get merchant of the current product
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    /**
     * Get category type of the current product
     */
    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_type_id');
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(related: AdditionProductTranslation::class, foreignKey: 'addition_product_id');
    }
}
