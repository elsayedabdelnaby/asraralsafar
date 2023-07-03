<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageTranslation extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'traveling_location',
        'type_of_rooms',
        'language_id',
        'package_id'
    ];
}
