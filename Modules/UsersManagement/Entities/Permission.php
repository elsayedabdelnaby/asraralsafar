<?php

namespace Modules\UsersManagement\Entities;

use App\Traits\HasLanguage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\UsersManagement\Entities\Model as ModulesModel;

class Permission extends Model
{
    use HasFactory, HasLanguage;

    /**
     * Get the module of the permission.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Get the model of the permission.
     */
    public function model()
    {
        return $this->belongsTo(ModulesModel::class, 'module_id');
    }

    /**
     * The profiles those belong to the permission.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_permissions');
    }
}
