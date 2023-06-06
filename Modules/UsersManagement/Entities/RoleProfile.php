<?php

namespace Modules\UsersManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleProfile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_profiles';

    /**
     * The role of the current role profile
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_profiles');
    }

    /**
     * The profile of the current role profile
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'role_profiles');
    }
}
