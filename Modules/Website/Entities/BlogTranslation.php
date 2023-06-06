<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'short_description', 'description', 'meta_title', 'meta_description', 'language_id', 'blog_id'];

    /**
     * return the related blog
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
