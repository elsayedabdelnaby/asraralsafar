<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use App\Scopes\MerchantId;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Modules\Locations\Entities\City;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchantBranch extends Model
{
    use HasFactory, SoftDeletes, IsActive, CurrentLanguageTranslation, Userstamps, LogsActivity,MerchantId;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'merchant_branches';

    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'is_active',
        'merchant_id',
        'city_id',
        'manager_id',
        'working_status',
        'rush_time_status',
        'rush_time_additional_fees',
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

    /**
     * @return BelongsTo
     * return the Related City
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(MerchantBranchTranslation::class, 'merchant_branch_id');
    }

}
