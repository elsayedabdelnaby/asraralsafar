<?php

namespace Modules\Operations\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\UsersManagement\Entities\Model;
use Wildside\Userstamps\Userstamps;

class DeliveryGuyInfo extends Model
{
    use SoftDeletes,Userstamps;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "delivery_guys";

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'insurance_amount',
        'allow_to_exceed',
        'exceed_amount',
        'number_of_delivered_orders',
        'current_balance',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
