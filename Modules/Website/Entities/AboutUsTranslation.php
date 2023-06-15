<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;

class AboutUsTranslation extends Model
{

    protected $fillable = [
        'title',
        'description',
        'language_id',
        'about_us_id',
    ];
    
}
