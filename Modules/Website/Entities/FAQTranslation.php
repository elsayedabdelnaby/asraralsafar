<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = ['question', 'answer', 'language_id', 'faq_id'];

    /**
     * return the related faq
     */
    public function faq()
    {
        return $this->belongsTo(FAQ::class, 'faq_id');
    }
}
