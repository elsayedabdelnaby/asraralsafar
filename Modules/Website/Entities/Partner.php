<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partners';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo_url'];

    /**
     * Interact with the logo's logo url.
     *
     * @return string
     */
    public function getLogoURLAttribute()
    {
        return $this->logo ? asset(Storage::url('website/partners/' . $this->logo)) : null;
    }
}
