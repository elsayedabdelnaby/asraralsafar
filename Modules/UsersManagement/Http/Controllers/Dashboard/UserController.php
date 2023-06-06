<?php

namespace Modules\UsersManagement\Http\Controllers\Dashboard;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\UsersManagement\Actions\Users\StoreUserAction;
use Modules\UsersManagement\Actions\Users\DeleteUserAction;
use Modules\UsersManagement\Actions\Users\ToggleUserAction;
use Modules\UsersManagement\Actions\Users\UpdateUserAction;
use Modules\UsersManagement\Actions\Users\GetAllUsersAction;
use Modules\UsersManagement\Http\Requests\Users\EditUserRequest;
use Modules\UsersManagement\Http\Requests\Users\StoreUserRequest;
use Modules\UsersManagement\Actions\Roles\GetAllActiveRolesAction;
use Modules\UsersManagement\Http\Requests\Users\DeleteUserRequest;
use Modules\UsersManagement\Http\Requests\Users\ToggleUserRequest;
use Modules\UsersManagement\Http\Requests\Users\UpdateUserRequest;
use Modules\UsersManagement\Actions\Users\UpdateUserPasswordAction;
use Modules\UsersManagement\Http\Requests\Users\UpdateUserPasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $users = (new GetAllUsersAction)->handle([
            ['type', 'admin']
        ]);
        if ($request->ajax()) {
            return [
                'data' => $users,
                'recordsTotal' => count($users),
                'recordsFiltered' => count($users),
            ];
        }
        return view('usersmanagement::users.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('usersmanagement::users.creating_editing.form')
            ->with([
                'roles' => (new GetAllActiveRolesAction)->handle(),
                'method' => 'POST',
                'action' => route('dashboard.users-management.users.store')
            ]);
    }

    /**
     * Store a newly created user in storage.
     * @param StoreUserAction $action
     * @param StoreUserRequest $request
     * @return Renderable
     */
    public function store(StoreUserRequest $request, StoreUserAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/usersmanagement/users')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/users')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usersmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditUserRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditUserRequest $request, $id)
    {
        return view('usersmanagement::users.creating_editing.form')
            ->with([
                'roles' => (new GetAllActiveRolesAction)->handle(),
                'method' => 'PUT',
                'action' => route('dashboard.users-management.users.update', ['id' => $id]),
                'user' => User::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param UpdateUserAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateUserRequest $request, UpdateUserAction $action, $id)
    {
        try {
            $action->handle($request, User::findOrFail($id));
            return redirect('dashboard/usersmanagement/users')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/users')->with(
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
        DeleteUserRequest $request,
        DeleteUserAction $action,
        int $id
    ) {
        try {
            $action->handle($request);
            return redirect('dashboard/usersmanagement/users')->with(
                'success',
                __('dashboard.deleted_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/users')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified user.
     * @param ToggleUserRequest $request
     * @param ToggleUserAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleUserRequest $toggle_request, ToggleUserAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('usersmanagement::dashboard.the_user_toggle_was_successfully'),
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * return the modal of the edit user password for the specified user.
     * @param int $id user id
     * @return Renderable
     */
    public function editPassword(int $id)
    {
        return response()->json([
            'status' => 'success',
            'html' => view('usersmanagement::users.editing.edit_password')
                ->with([
                    'id' => $id,
                ])
                ->render(),
        ]);
    }


    /**
     * Update the password for the specified user.
     * @param UpdateUserPasswordRequest $request
     * @param UpdateUserPasswordAction $action
     * @param int $id
     * @return Renderable
     */
    public function updatePassword(UpdateUserPasswordRequest $update_password_request, UpdateUserPasswordAction $action, int $id)
    {
        try {
            $action->handle($update_password_request);
            return redirect('dashboard/usersmanagement/users')->with(
                'success',
                __('usersmanagement::dashboard.password_changed_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/users')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the user which will replace by the another user
     * @param int $id
     * @return Renderable
     */
    public function delete(int $id)
    {
        $users = (new GetAllUsersAction())->handle(
            [
                ['type', 'admin'],
                ['users.is_active', 1],
                ['users.id', '<>', $id]
            ]
        );

        return response()->json([
            'status' => 'success',
            'html' => view('usersmanagement::users.deleting.form')
                ->with([
                    'item' => User::findOrFail($id),
                    'other_items' => $users,
                ])
                ->render(),
        ]);
    }
}
