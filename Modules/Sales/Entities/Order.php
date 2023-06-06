<?php

namespace Modules\Sales\Entities;

use App\Scopes\MerchantBranchesIds;
use Modules\Operations\Entities\DeliveryGuy;
use Wildside\Userstamps\Userstamps;
use Modules\Merchants\Entities\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Merchants\Entities\MerchantBranch;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Userstamps, SoftDeletes, MerchantBranchesIds;

    protected $table = 'orders';

    protected $fillable = [
        'merchant_branch_id',
        'customer_id',
        'address_id',
        'delivery_id',
        'coupon_id',
        'payment_address',
        'total',
        'order_status_id',
    ];

    /**
     * @return BelongsTo
     */
    public function merchantBranch(): belongsTo
    {
        return $this->belongsTo(MerchantBranch::class);
    }

    /**
     * @return BelongsTo
     */
    public function customer(): belongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo
     */
    public function address(): belongsTo
    {
        return $this->belongsTo(CustomerAddress::class, 'address_id');
    }

    /**
     * @return BelongsTo
     */
    public function delivery(): belongsTo
    {
        return $this->belongsTo(DeliveryGuy::class);
    }

    /**
     * @return BelongsTo
     */
    public function coupon(): belongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return HasMany
     * return the Related Merchant
     */
    public function orderProducts(): HasMany
    {
        return $this->HasMany(OrderProduct::class);
    }

    /**
     * @return BelongsTo
     */
    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }


}
