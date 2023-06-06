<?php

namespace Modules\UsersManagement\Entities;

use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avatar extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avatars';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Interact with the social link's image url.
     *
     * @return string
     */
    public function getImageURLAttribute()
    {
        return $this->image ? asset(Storage::url('users/avatars/' . $this->image)) : null;
    }

    /**
     * return the users who have this avatar
     */
    public function users()
    {
        return $this->hasMany(User::class, 'avatar_id');
    }
}
