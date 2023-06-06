<?php

namespace Modules\UsersManagement\Entities;

use App\Models\User;
use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory,
        IsActive,
        Userstamps,
        CurrentLanguageTranslation,
        SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'actions'];

    /**
     * get the role name
     */
    public function getNameAttribute()
    {
        $role = $this;
        return Cache::rememberForever(
            'users_management_role_' . $this->id . '_' . App::getLocale(),
            function () use ($role) {
                $role = $role
                    ->translations()
                    ->where('language_id', getCurrentLanguage()->id)
                    ->first();
                return $role ? $role->name : null;
            }
        );
    }

    /**
     * get the actions attribute
     */
    public function getActionsAttribute()
    {
        return null;
    }

    /**
     * get the report to role
     */
    public function reportTo()
    {
        return $this->belongsTo(Role::class, 'report_to');
    }

    /**
     * get the users of the role
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * get the profiles of the translation
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'role_profiles');
    }

    /**
     * get the translations of the role
     */
    public function translations()
    {
        return $this->hasMany(RoleTranslation::class);
    }

    /**
     * get the permissions of the role
     */
    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Profile::class);
    }

    /**
     * get all roles which report to the current role
     */
    public function reportsToMe()
    {
        return $this->hasMany(Role::class, 'report_to');
    }

    /**
     * get all sub main roles
     */
    public function subMainRoles()
    {
        return Role::where('report_to', $this->id)->get();
    }

    /**
     * get all sub roles
     */
    public function subRoles()
    {
        return Role::where([
            ['root_path', 'LIKE', "%{$this->root_path}%"],
            ['id', '<>', $this->id],
        ])->get();
    }
}
