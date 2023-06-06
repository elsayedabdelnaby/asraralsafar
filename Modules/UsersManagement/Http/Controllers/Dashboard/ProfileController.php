<?php

namespace Modules\UsersManagement\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Profile;
use Modules\UsersManagement\Actions\Profiles\CreateProfileAction;
use Modules\UsersManagement\Actions\Profiles\DeleteProfileAction;
use Modules\UsersManagement\Actions\Profiles\UpdateProfileAction;
use Modules\UsersManagement\Actions\Profiles\GetAllProfilesAction;
use Modules\UsersManagement\Http\Requests\Profiles\CreateProfileRequest;
use Modules\UsersManagement\Http\Requests\Profiles\DeleteProfileRequest;
use Modules\UsersManagement\Http\Requests\Profiles\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $profiles = (new GetAllProfilesAction())->handle(true);
            return [
                'data' => $profiles,
                'recordsTotal' => count($profiles),
                'recordsFiltered' => count($profiles),
            ];
        }
        return view('usersmanagement::profiles.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('usersmanagement::profiles.creating.form')->with([
            'modules' => Module::with('models')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProfileRequest $request
     * @param CreateProfileAction $action
     * @return Renderable
     */
    public function store(
        CreateProfileRequest $request,
        CreateProfileAction $action
    ) {
        try {
            $action->handle($request);
            return redirect('dashboard/usersmanagement/profiles')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/profiles')->with(
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
        $profile = Profile::with(
            'translations.language',
            'permissions'
        )->findOrFail($id);
        return view('usersmanagement::profiles.showing.show')->with([
            'profile' => $profile,
            'modules' => Module::with('models')->get(),
            'profile_permissions' => $profile
                ->permissions()
                ->pluck('permissions.id')
                ->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $profile = Profile::findOrFail($id);
            return view('usersmanagement::profiles.editing.form')->with([
                'modules' => Module::with('models')->get(),
                'profile' => $profile,
                'profile_permissions' => $profile
                    ->permissions()
                    ->pluck('permissions.id')
                    ->toArray(),
            ]);
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/profiles')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProfileRequest $request
     * @param UpdateProfileAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(
        UpdateProfileRequest $request,
        UpdateProfileAction $action,
        $id
    ) {
        try {
            $action->handle($request, Profile::findOrFail($id));
            return redirect('dashboard/usersmanagement/profiles')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/profiles')->with(
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
        DeleteProfileRequest $request,
        DeleteProfileAction $action,
        int $id
    ) {
        try {
            $action->handle($request);
            return redirect('dashboard/usersmanagement/profiles')->with(
                'success',
                __('dashboard.deleted_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/usersmanagement/profiles')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted profile
     * @param int $id
     * @return Renderable
     */
    public function delete(int $id)
    {
        $profiles = (new GetAllProfilesAction())->handle(false, [
            'profiles.id',
            '<>',
            $id,
        ]);

        return response()->json([
            'status' => 'success',
            'html' => view('usersmanagement::profiles.deleting.form')
                ->with([
                    'item' => Profile::findOrFail($id),
                    'other_items' => $profiles,
                ])
                ->render(),
        ]);
    }
}
