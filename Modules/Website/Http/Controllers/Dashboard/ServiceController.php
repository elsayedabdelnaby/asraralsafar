<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\Service;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Services\StoreServiceAction;
use Modules\Website\Actions\Services\DeleteServiceAction;
use Modules\Website\Actions\Services\ToggleServiceAction;
use Modules\Website\Actions\Services\UpdateServiceAction;
use Modules\Website\Actions\Services\GetAllServicesAction;
use Modules\Website\Http\Requests\Services\EditServiceRequest;
use Modules\Website\Http\Requests\Services\StoreServiceRequest;
use Modules\Website\Http\Requests\Services\DeleteServiceRequest;
use Modules\Website\Http\Requests\Services\ToggleServiceRequest;
use Modules\Website\Http\Requests\Services\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = (new GetAllServicesAction)->handle();
            $services = $services->select([
                'services.id',
                'service_translations.name',
                'display_order',
                'is_active',
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($services);
            return [
                'data' => $services,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::services.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('website::services.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.services.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreServiceRequest $request
     * @param StoreServiceAction $action
     * @return Renderable
     */
    public function store(StoreServiceRequest $request, StoreServiceAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/services')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/services')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleServiceRequest $request
     * @param ToggleServiceAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleServiceRequest $toggle_request, ToggleServiceAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_service_toggle_was_successfully'),
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
     * @param EditServiceRequest $request
     * @return Renderable
     */
    public function edit(EditServiceRequest $request)
    {
        return view('website::services.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.services.update', ['id' => $request->id]),
                'service' => Service::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateServiceRequest $request
     * @param UpdateServiceAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateServiceRequest $request, UpdateServiceAction $action)
    {
        try {
            $action->handle($request, Service::findOrFail($request->id));
            return redirect('dashboard/website/services')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/services')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteServiceRequest $request
     * @param DeleteServiceAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteServiceRequest $request, DeleteServiceAction $action)
    {
        return $action->handle($request);
    }
}
