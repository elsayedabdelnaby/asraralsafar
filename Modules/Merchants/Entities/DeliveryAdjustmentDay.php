<?php

namespace Modules\Merchants\Entities;

use App\Scopes\CurrentLanguageTranslation;
use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAdjustmentDay extends Model
{
    use HasFactory, SoftDeletes, IsActive, CurrentLanguageTranslation;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'delivery_adjustment_days';

    /**
     * @var string[]
     */
    protected $fillable = [
        'day_name',
        'delivery_adjustment_id',
    ];

    /**
     *  get Related Belongs To
     */
    public function deliveryAdjustments():BelongsTo
    {
        return $this->belongsTo(DeliveryAdjustments::class,'delivery_adjustment_id');
    }

}
