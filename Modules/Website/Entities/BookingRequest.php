<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'sex',
        'dob',
        'service',
        'service_date',
        'service_details'
    ];
}
