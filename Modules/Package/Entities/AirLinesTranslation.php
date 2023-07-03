<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AirLinesTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Package\Database\factories\AirLinesTranslationFactory::new();
    }
}
