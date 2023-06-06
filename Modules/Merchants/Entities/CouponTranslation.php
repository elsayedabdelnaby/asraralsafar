<?php

namespace Modules\Merchants\Entities;

use App\Models\Language;
use App\Traits\HasLanguage;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage, LogsActivity;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'coupon_translations';
    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'name',
        'coupon_id',
        'language_id'
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
     * return the Related Merchant Branch
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    /**
     * @return BelongsTo
     * return the Related Language
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
