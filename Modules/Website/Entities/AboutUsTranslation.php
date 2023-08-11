<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUsTranslation extends Model
{
    use HasFactory, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about_us_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'language_id',
        'about_us_id',
    ];

    /**
     * return the related about us
     */
    public function aboutus()
    {
        return $this->belongsTo(AboutUs::class, 'about_us_id');
    }
}
