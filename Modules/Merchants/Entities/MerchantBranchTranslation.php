<?php

namespace Modules\Merchants\Entities;

use App\Models\Language;
use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MerchantBranchTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage, LogsActivity;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'merchant_branches_translations';
    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'rush_time_message',
        'merchant_branch_id',
        'language_id',
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
    public function merchantBranch(): BelongsTo
    {
        return $this->belongsTo(MerchantBranch::class, 'merchant_branch_id');
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
