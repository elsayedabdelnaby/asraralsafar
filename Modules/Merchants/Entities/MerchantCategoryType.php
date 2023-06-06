<?php

namespace Modules\Merchants\Entities;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Category;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchantCategoryType extends Model
{
    use HasFactory, Userstamps, LogsActivity;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'merchant_category_types';

    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'merchant_id',
        'category_id',
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
     * return the Related Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
