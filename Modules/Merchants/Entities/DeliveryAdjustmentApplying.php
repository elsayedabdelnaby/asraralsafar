<?php

namespace Modules\Merchants\Entities;

use App\Scopes\CurrentLanguageTranslation;
use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Locations\Entities\City;
use Wildside\Userstamps\Userstamps;

class DeliveryAdjustmentApplying extends Model
{
    use HasFactory, SoftDeletes, IsActive, Userstamps, CurrentLanguageTranslation;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'delivery_adjustment_applying';

    /**
     * @var string[]
     */
    protected $fillable = [
        'delivery_adjustment_id',
        'from_city_id',
        'to_city_id',
        'merchants_id',
        'product_id',
    ];

    /**
     *  get Related Belongs To
     */
    public function deliveryAdjustments(): BelongsTo
    {
        return $this->belongsTo(DeliveryAdjustments::class, 'delivery_adjustment_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchants_id');
    }

    /**
     * @return BelongsTo
     */
    public function cityFrom(): BelongsTo
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    /**
     * @return BelongsTo
     */
    public function cityTo(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }


    /**
     * @return int
     */
    public function MerchantProduct():int
    {
        return $this->product()->first()->merchant_id;
    }

}
