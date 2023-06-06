<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialLink extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_links';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['icon_url'];

    /**
     * Interact with the social link's icon url.
     *
     * @return string
     */
    public function getIconURLAttribute()
    {
        return $this->icon ? asset(Storage::url('website/social_links/' . $this->icon)) : null;
    }
}
