<?php

namespace Modules\UsersManagement\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;
use Modules\UsersManagement\Entities\Avatar;
use Modules\UsersManagement\Actions\Avatars\StoreAvatarAction;
use Modules\UsersManagement\Actions\Avatars\DeleteAvatarAction;
use Modules\UsersManagement\Actions\Avatars\ToggleAvatarAction;
use Modules\UsersManagement\Actions\Avatars\UpdateAvatarAction;
use Modules\UsersManagement\Http\Requests\Avatars\EditAvatarRequest;
use Modules\UsersManagement\Http\Requests\Avatars\StoreAvatarRequest;
use Modules\UsersManagement\Http\Requests\Avatars\DeleteAvatarRequest;
use Modules\UsersManagement\Http\Requests\Avatars\ToggleAvatarRequest;
use Modules\UsersManagement\Http\Requests\Avatars\UpdateAvatarRequest;

class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $avatars = Avatar::select([
                'avatars.id',
                'is_active',
                'avatars.image',
                DB::raw('CONCAT("' . asset(Storage::url('users/avatars')) . '/' . '", image) as avatar_url'),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($avatars);
            return [
                'data' => $avatars,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('usersmanagement::avatars.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('usersmanagement::avatars.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.users-management.avatars.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreAvatarRequest $request
     * @param StoreAvatarAction $action
     * @return Renderable
     */
    public function store(StoreAvatarRequest $request, StoreAvatarAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/usersmanagement/avatars')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/avatars')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleAvatarRequest $request
     * @param ToggleAvatarAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleAvatarRequest $toggle_request, ToggleAvatarAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('usersmanagement::dashboard.the_avatar_toggle_was_successfully'),
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
     * Show the form for editing the specified resource.
     * @param EditAvatarRequest $request
     * @return Renderable
     */
    public function edit(EditAvatarRequest $request)
    {
        return view('usersmanagement::avatars.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.users-management.avatars.update', ['id' => $request->id]),
                'avatar' => Avatar::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateAvatarRequest $request
     * @param UpdateAvatarAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateAvatarRequest $request, UpdateAvatarAction $action)
    {
        try {
            $action->handle($request, Avatar::findOrFail($request->id));
            return redirect('dashboard/usersmanagement/avatars')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/avatars')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteAvatarRequest $request
     * @param DeleteAvatarAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteAvatarRequest $request, DeleteAvatarAction $action)
    {
        return $action->handle($request);
    }
}
