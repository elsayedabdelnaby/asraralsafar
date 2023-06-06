<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Modules\Locations\Entities\City;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Category;
use Modules\Settings\Traits\WithCategory;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, IsActive, Userstamps, CurrentLanguageTranslation, WithCategory, LogsActivity;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'coupons';

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'merchant_id',
        'type',
        'value_type',
        'value',
        'start_date',
        'end_date',
        'one_time',
        'first_order',
        'limited_usage',
        'user_max_usage',
        'min_order',
        'max_order',
        'min_shipping',
        'max_shipping',
        'apply_on_cash',
        'apply_on_card',
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
     * @return BelongsTo
     * return the Related Merchant
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    /**
     * Get all the categories for the coupon.
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CouponTranslation::class, 'coupon_id');
    }

    /**
     * get all related translations
     */
    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class,'coupon_applying', 'coupon_id', 'city_id', 'id', 'id');
    }

    /**
     * get all related translations
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'coupon_applying');
    }

    /**
     * get all related translations
     */
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(MerchantBranch::class,'coupon_applying', 'coupon_id', 'branch_id');
    }
}
