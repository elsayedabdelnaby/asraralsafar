<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsiteInformationTranslation extends Model
{
    use HasFactory, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_information_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['website_information_id', 'language_id', 'name'];

    /**
     * return the website information which related by the current website information translations.
     */
    public function websiteinformation()
    {
        return $this->belongsTo(WebsiteInformation::class, 'website_information_id');
    }
}
