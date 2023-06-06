<?php

namespace Modules\Settings\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tag_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'language_id',
        'tag_id'
    ];

    /**
     * return the related tag
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
