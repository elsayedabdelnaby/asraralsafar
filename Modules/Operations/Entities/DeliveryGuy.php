<?php

namespace Modules\Operations\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class DeliveryGuy extends User
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "users";

    /**
     * @return HasMany  Of Cities
     */
    public function deliveryGuyCities(): HasMany
    {
        return $this->hasMany(DeliveryGuyCity::class, 'user_id');
    }


    /**
     * @return HasOne
     */
    public function deliveryGuyInfo()
    {
        return $this->hasOne(DeliveryGuyInfo::class,'user_id');
    }

}
