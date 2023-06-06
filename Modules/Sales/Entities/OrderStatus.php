<?php

namespace Modules\Sales\Entities;

use App\Scopes\CurrentLanguageTranslation;
use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory, Userstamps, SoftDeletes,IsActive,CurrentLanguageTranslation;

    /**
     * @var string
     */
    protected $table = 'order_status';

    protected $fillable = [
        'display_order',
        'color',
        'is_active'
    ];

     /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(related: OrderStatusTranslation::class, foreignKey: 'order_status_id');
    }
}
