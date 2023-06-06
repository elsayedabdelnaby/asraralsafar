<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Entities\MerchantBranch;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Modules\Sales\Entities\CustomerAddress;
use Modules\UsersManagement\Entities\Role;
use Spatie\Activitylog\Traits\LogsActivity;
use Modules\UsersManagement\Entities\Avatar;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, IsActive, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'otp',
        'password',
        'type',
        'role_id',
        'avatar_id',
        'image_profile',
        'is_active',
        'report_id',
        'news_letter',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = ['image_profile_url', 'avatar_url'];

    /**
     * return the image profile's url of the user.
     *
     * @return string|null
     */
    protected function getImageProfileUrlAttribute(): string|null
    {
        return $this->image_profile ? asset(Storage::url('users/' . $this->image_profile)) : null;
    }

    /**
     * return the avatar profile's url of the user.
     *
     * @return string|null
     */
    protected function getAvatarUrlAttribute(): string|null
    {
        $avatar = $this->avatar();
        return $avatar ? $avatar->image_url : null;
    }

    /**
     * return the role of the user
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * get the permissions of the user
     */
    public function permissions()
    {
        $user = $this;
//        return Cache::rememberForever('user_permissions_' . $this->id, function () use ($user) {
            return DB::table('permissions')->join('profile_permissions', 'permissions.id', '=', 'profile_permissions.permission_id')
                ->join('profiles', 'profiles.id', '=', 'profile_permissions.profile_id')
                ->join('role_profiles', 'role_profiles.profile_id', '=', 'profiles.id')
                ->join('modules', 'permissions.module_id', '=', 'modules.id')
                ->leftJoin('models', 'permissions.model_id', '=', 'models.id')
                ->select(
                    [
                        'permissions.id',
                        DB::raw('permissions.name AS permission'),
                        DB::raw('modules.name AS module_name'),
                        DB::raw('models.name AS model_name'),
                    ]
                )
                ->where([
                    ['role_profiles.role_id', $user->role_id],
                    ['modules.is_active', 1]
                ])->where(function ($query) {
                    $query->where('models.is_active', 1)->orWhereNull('permissions.model_id');
                })->get();
//        });
    }

    /**
     * @param string $permission
     * check if the user has this permission or not
     * @return boolean
     */
    public function hasPermission(string $permission)
    {
         $permissions = $this->permissions()->where('permission', $permission);
        return count($permissions) ? true : false;
    }

    /**
     * @param array $permissions
     * check if the user has any permissions
     * @return boolean
     */
    public function hasAnyPermission(array $permissions)
    {
        $permissions = $this->permissions()->whereIn('permission', $permissions);
        return count($permissions) ? true : false;
    }

    /**
     * return the avatar of the user
     */
    public function avatar()
    {
        return $this->belongsTo(Avatar::class, 'avatar_id')->first();
    }

    /**
     * return the merchant manager to the current branch manager user
     */
    public function merchantManager()
    {
        return $this->belongsTo(User::class, 'report_id');
    }

    /**
     * log any activity on the current model
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty();
    }

    /**
     * @return BelongsTo
     * retutn Merchant If User Role is Merchant Manager
     */
    public function merchant():BelongsTo
    {
        return $this->belongsTo(Merchant::class,'id','owner_id');
    }

    /**
     * @return BelongsTo
     * retutn Merchant If User Role is Merchant Branch Manager
     */
    public function branch():BelongsTo
    {
        return $this->belongsTo(MerchantBranch::class,'id','manager_id');
    }
}
