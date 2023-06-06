<?php

namespace Modules\UsersManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePermission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_permissions';

    /**
     * The permission of the current profile permission
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'profile_permissions');
    }

    /**
     * The profile of the current profile permission
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_permissions');
    }
}
