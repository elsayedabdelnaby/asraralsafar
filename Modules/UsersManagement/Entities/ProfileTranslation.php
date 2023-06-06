<?php

namespace Modules\UsersManagement\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileTranslation extends Model
{
    use HasFactory, HasLanguage, SoftDeletes;

    protected $table = 'profile_translations';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * get the profile of the translation
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
