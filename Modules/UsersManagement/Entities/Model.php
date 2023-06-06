<?php

namespace Modules\UsersManagement\Entities;

use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasFactory, IsActive, SoftDeletes;

    /**
     * Get the module that owns the model.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Get the permissions of the model.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }
}
