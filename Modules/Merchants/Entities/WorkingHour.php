<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingHour extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, LogsActivity;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'merchant_working_hours';

    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'day',
        'from',
        'to',
        'is_active'
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
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}
