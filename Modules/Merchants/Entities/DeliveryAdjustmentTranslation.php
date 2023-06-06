<?php

namespace Modules\Merchants\Entities;

use App\Models\Language;
use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAdjustmentTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     *  The Table Associated With the Model
     * @var string
     */
    protected $table = 'delivery_adjustment_translations';
    /**
     * The Accessors To Append to the model's array From
     * @var string[]
     */
    protected $fillable = [
        'delivery_adjustment_id',
        'language_id',
        'name',
        'description'
    ];

    /**
     * @return BelongsTo
     * return the Related Merchant Branch
     */
    public function deliveryAdjustments(): BelongsTo
    {
        return $this->belongsTo(DeliveryAdjustments::class, 'delivery_adjustment_id');
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
