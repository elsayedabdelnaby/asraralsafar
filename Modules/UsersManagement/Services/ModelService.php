<?php

namespace Modules\UsersManagement\Services;

use Modules\UsersManagement\Entities\Model;
use Modules\UsersManagement\Entities\Permission;

class ModelService
{
    /**
     * create a model and assign permissions to the model
     * @var Model
     */
    public function createModelAndAssignPermissions(string $model_name, int $module_id, array $permissions, string $guard = 'web'): Model
    {
        $model = Model::create(['name' => $model_name, 'module_id' => $module_id, 'created_at' => now(), 'updated_at' => now()]);
        $this->assignPermissionsToModel($model, $permissions, $guard);
        return $model;
    }

    /**
     * insert permissions of the model
     * @param Model $model
     * @param array $permissions
     * @param string $guard
     * @return boolean
     */
    public function assignPermissionsToModel(Model $model, array $permissions, string $guard = 'web'): bool
    {
        // insert all permissions to the model
        $permissions = $this->preparePermissionsArray($model->module_id, $model->id, $permissions, $guard);
        return Permission::insert($permissions);
    }

    /**
     * prepare permissions array
     * @param int $module_id
     * @param int $model_id
     * @param array $permissions
     * @param string $guard
     * @return array
     */
    private function preparePermissionsArray(int $module_id, int $model_id, array $permissions, $guard = 'web'): array
    {
        $prepare_permissions = [];
        foreach ($permissions as $permission) {
            $prepare_permissions[] = [
                'name' => $permission,
                'module_id' => $module_id,
                'model_id' => $model_id,
                'guard_name' => $guard,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $prepare_permissions;
    }
}
