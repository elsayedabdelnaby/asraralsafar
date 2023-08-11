<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\Partner;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Partners\StorePartnerAction;
use Modules\Website\Actions\Partners\DeletePartnerAction;
use Modules\Website\Actions\Partners\TogglePartnerAction;
use Modules\Website\Actions\Partners\UpdatePartnerAction;
use Modules\Website\Actions\Partners\GetAllPartnersAction;
use Modules\Website\Http\Requests\Partners\EditPartnerRequest;
use Modules\Website\Http\Requests\Partners\StorePartnerRequest;
use Modules\Website\Http\Requests\Partners\DeletePartnerRequest;
use Modules\Website\Http\Requests\Partners\TogglePartnerRequest;
use Modules\Website\Http\Requests\Partners\UpdatePartnerRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $partners = (new GetAllPartnersAction)->handle();
            $total = count($partners);
            return [
                'data' => $partners,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::partners.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::partners.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.partners.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StorePartnerRequest $request
     * @param StorePartnerAction $action
     * @return Renderable
     */
    public function store(StorePartnerRequest $request, StorePartnerAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/partners')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/partners')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param TogglePartnerRequest $request
     * @param TogglePartnerAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(TogglePartnerRequest $toggle_request, TogglePartnerAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_partner_toggle_was_successfully'),
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
     * @param EditPartnerRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditPartnerRequest $request, $id)
    {
        return view('website::partners.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.partners.update', ['id' => $id]),
                'partner' => Partner::find($id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePartnerRequest $request
     * @param UpdatePartnerAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePartnerRequest $request, UpdatePartnerAction $action, $id)
    {
        try {
            $action->handle($request, Partner::find($id));
            return redirect('dashboard/website/partners')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/partners')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeletePartnerRequest $request
     * @param DeletePartnerAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeletePartnerRequest $request, DeletePartnerAction $action, $id)
    {
        return $action->handle($request);
    }
}
