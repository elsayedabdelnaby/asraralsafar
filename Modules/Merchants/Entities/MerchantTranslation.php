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

class MerchantTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage, LogsActivity;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'merchant_translations';

    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'language_id',
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'rush_time_message',
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
     * get all related Language
     */

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, "language_id");
    }
}
