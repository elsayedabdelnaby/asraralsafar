<?php

namespace Modules\Merchants\Entities;


use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchantSocial extends Model
{
    use HasFactory, SoftDeletes, IsActive, Userstamps, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_social';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $appends = ['icon_url'];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'display',
        'icon',
        'url',
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
     * get all related Merchant
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    /**
     * Interact with the icon url
     *
     * @return string
     */
    public function getIconUrlAttribute(): ?string
    {
        return $this->icon ? asset(Storage::url('merchants/social/' . $this->icon)) : null;
    }
}
