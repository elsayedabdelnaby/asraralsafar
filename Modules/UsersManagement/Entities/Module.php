<?php

namespace Modules\UsersManagement\Entities;

use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\UsersManagement\Entities\Model as ModulesModel;

class Module extends Model
{
    use HasFactory, IsActive, SoftDeletes;

    /**
     * Get the models of the module.
     */
    public function models()
    {
        return $this->hasMany(ModulesModel::class, 'module_id');
    }

    /**
     * Get the permissions of the module.
     */
    public function permssions()
    {
        return $this->hasMany(Permission::class);
    }
}
