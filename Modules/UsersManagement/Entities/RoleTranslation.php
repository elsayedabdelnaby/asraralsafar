<?php

namespace Modules\UsersManagement\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleTranslation extends Model
{
    use HasFactory, HasLanguage, SoftDeletes;

    protected $table = 'role_translations';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * get the role of the translation
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
