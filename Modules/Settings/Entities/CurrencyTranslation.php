<?php

namespace Modules\Settings\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurrencyTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currency_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'currency_id',
        'language_id'
    ];

    /**
     * return the related currency
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
