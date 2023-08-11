<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestimonailTranslation extends Model
{
    use HasFactory, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimonail_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = ['client_name', 'testimonail', 'language_id', 'testimonail_id'];

    /**
     * return the related testimonail
     */
    public function testimonail()
    {
        return $this->belongsTo(Testimonail::class, 'testimonail_id');
    }
}
