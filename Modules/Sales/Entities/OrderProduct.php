<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Merchants\Entities\Product;

class OrderProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_products';

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity',
    ];

    /**
     * @return BelongsTo
     * return the Related Merchant
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
