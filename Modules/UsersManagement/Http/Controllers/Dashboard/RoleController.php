<?php

namespace Modules\UsersManagement\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UsersManagement\Entities\Role;
use Illuminate\Contracts\Support\Renderable;
use Modules\UsersManagement\Actions\Roles\StoreRoleAction;
use Modules\UsersManagement\Actions\Roles\DeleteRoleAction;
use Modules\UsersManagement\Actions\Roles\UpdateRoleAction;
use Modules\UsersManagement\Http\Requests\Roles\StoreRoleRequest;
use Modules\UsersManagement\Actions\Profiles\GetAllProfilesAction;
use Modules\UsersManagement\Http\Requests\Roles\CreateRoleRequest;
use Modules\UsersManagement\Http\Requests\Roles\DeleteRoleRequest;
use Modules\UsersManagement\Http\Requests\Roles\UpdateRoleRequest;
use Modules\UsersManagement\Http\Requests\Roles\ShowEditRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $role = Role::findOrFail(1);
        return view('usersmanagement::roles.indexing.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateRoleRequest $request)
    {
        return view('usersmanagement::roles.creating.form')->with([
            'report_to' => $request->get('report_to'),
            'profiles' => (new GetAllProfilesAction())->handle(false, [
                'profiles.is_active',
                1,
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRoleRequest $request, StoreRoleAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/usersmanagement/roles')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/roles')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ShowEditRoleRequest $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role_profiles = $role
                ->profiles()
                ->pluck('profiles.id')
                ->toArray();
            return view('usersmanagement::roles.editing.form')->with([
                'role' => $role,
                'report_to' => $request->get('report_to'),
                'role_profiles' => $role_profiles,
                'profiles' => (new GetAllProfilesAction())->handle(false, [
                    'profiles.is_active',
                    1,
                ]),
            ]);
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/roles')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(
        UpdateRoleRequest $request,
        UpdateRoleAction $action,
        $id
    ) {
        try {
            $action->handle($request, Role::findOrFail($id));
            return redirect('dashboard/usersmanagement/roles')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/roles')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(
        DeleteRoleRequest $request,
        DeleteRoleAction $action,
        int $id
    ) {
        try {
            return $action->handle($request);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
