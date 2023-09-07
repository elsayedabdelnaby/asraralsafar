<?php

namespace Modules\Operations\Entities;

use Modules\Website\Entities\Service;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'sex',
        'dob',
        'service_id',
        'service_date',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
