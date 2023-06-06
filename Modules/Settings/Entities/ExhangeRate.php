<?php

namespace Modules\Settings\Entities;

use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExhangeRate extends Model
{
    use HasFactory, SoftDeletes, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exchange_rates';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_currency_id',
        'to_currency_id',
        'rate',
        'is_active',
    ];

    /**
     * get the Form Currency
     */
    public function from()
    {
        return $this->belongsTo(Currency::class, 'from_currency_id');
    }

    /**
     * get the to Currency
     */
    public function to()
    {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }
}
