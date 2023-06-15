<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Modules\Website\Entities\AboutUsTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use CurrentLanguageTranslation;

    protected $fillable = [];

    public function translations()
    {
        return $this->hasMany(AboutUsTranslation::class);
    }
}
