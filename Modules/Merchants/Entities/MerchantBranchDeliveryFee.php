<?php

namespace Modules\Merchants\Entities;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchantBranchDeliveryFee extends Model
{
    use HasFactory,SoftDeletes ,Userstamps, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_branch_delivery_fees';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'fees',
        'merchant_branch_id',
    ];

    /**
     * log any activity on the current model
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty();
    }

    /**
     * @return BelongsTo
     * return the Related Merchant
     */
    public function merchantBranch(): BelongsTo
    {
        return $this->belongsTo(MerchantBranch::class, 'merchant_branch_id');
    }

}
