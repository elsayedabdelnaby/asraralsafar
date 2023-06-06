<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class ContactInformation extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_informations';
}
