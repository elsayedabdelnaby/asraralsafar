<?php

namespace Modules\Merchants\Entities;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Category;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MerchantCuisine extends Model
{
    use HasFactory, Userstamps, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchant_cuisines';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
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
