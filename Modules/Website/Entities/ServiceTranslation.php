<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceTranslation extends Model
{
    use HasFactory, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'service_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'language_id', 'service_id', 'meta_title', 'meta_description', 'slug'];

    protected $append = ["title"];

    /**
     * Return the name of the service dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function title(): Attribute
    {
        $service = $this;
        return new Attribute(
            get: fn () => $service->name,
        );
    }

    /**
     * return the related service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
