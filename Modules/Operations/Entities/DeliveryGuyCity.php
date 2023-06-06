<?php

namespace Modules\Operations\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Locations\Entities\City;

class DeliveryGuyCity extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "delivery_guy_cities";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'city_id',
    ];

    /**
     * Get Delivery Guy
     */
    public function deliveryGuy(): BelongsTo
    {
        return $this->belongsTo(DeliveryGuy::class, 'user_id');
    }

    /**
     * Get City
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Get City
     */
    public function deliveries(): BelongsTo
    {
        return $this->belongsTo(DeliveryGuy::class, 'user_id');
    }

    /**
     * Get Country
     */
    public function country(){
        $city = $this->city()->first();
        dd($city);
        return "";
    }
}
