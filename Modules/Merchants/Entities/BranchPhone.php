<?php

namespace Modules\Merchants\Entities;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchPhone extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branch_phones';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'phone',
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
     * Get All Related Branches
     */
    public function branche(): BelongsTo
    {
        return $this->belongsTo(MerchantBranch::class, 'branch_id');
    }
}
