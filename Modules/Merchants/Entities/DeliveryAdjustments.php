<?php

namespace Modules\Merchants\Entities;

use App\Scopes\CurrentLanguageTranslation;
use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class DeliveryAdjustments extends Model
{
    use HasFactory, SoftDeletes, IsActive, Userstamps, CurrentLanguageTranslation;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'delivery_adjustments';

    /**
     * @var string[]
     */
    protected $fillable = [
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'minimum_order_value',
        'maximum_order_value',
        'minimum_shipping_cost_value',
        'maximum_shipping_cost_value',
        'type',
        'value_type',
        'value',
        'apply_on_cash_on_delivery',
        'apply_on_pay_from_wallet',
        'is_active',
    ];

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(DeliveryAdjustmentTranslation::class, 'delivery_adjustment_id');
    }

    /**
     * Days
     */

    public function days(): HasMany
    {
        return $this->hasMany(DeliveryAdjustmentDay::class, 'delivery_adjustment_id');
    }

    /**
     * Applying
     */
    public function applying(): HasMany
    {
        return $this->hasMany(DeliveryAdjustmentApplying::class,'delivery_adjustment_id');
    }
}
