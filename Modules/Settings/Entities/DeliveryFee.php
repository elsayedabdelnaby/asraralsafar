<?php

namespace Modules\Settings\Entities;

use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryFee extends Model
{
    use HasFactory, SoftDeletes, IsActive, Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'delivery_fees';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'fees',
        'is_active',
    ];
}
