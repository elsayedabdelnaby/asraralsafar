<?php

namespace App\Models;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, LogsActivity;

    protected $appends = ['icon_url'];

    protected $fillable = [
        'name',
        'icon',
        'code',
        'direction',
        'is_active'
    ];

    /**
     * get the icon url of the language
     */
    public function getIconURLAttribute()
    {
        return asset(Storage::url('settings/languages/' . $this->icon));
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
}
