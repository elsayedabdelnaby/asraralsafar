<?php

namespace Modules\Settings\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTypeTranslation extends Model
{
    use HasFactory, SoftDeletes, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_type_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'language_id',
        'category_type_id'
    ];

    /**
     * return the related category type
     */
    public function categorytype()
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
    }
}
