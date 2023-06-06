<?php

namespace Modules\Sales\Entities;

use Wildside\Userstamps\Userstamps;
use Modules\Locations\Entities\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "customer_addresses";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'city_id',
        'latitude',
        'longitude',
        'phone_number',
        'address',
        'build_no',
        'floor_no',
        'apartment_no',
        'is_default',
    ];

    /**
     * get the customer of the address
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * get the city of the address
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
