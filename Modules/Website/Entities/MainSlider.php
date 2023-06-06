<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainSlider extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'main_sliders';

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
        return $this->image ? asset(Storage::url('website/main_sliders/' . $this->image)) : null;
    }
}
