<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Enums\ContactInformationType;
use Modules\Website\Actions\ContactInformations\StoreContactInformationAction;
use Modules\Website\Actions\ContactInformations\DeleteContactInformationAction;
use Modules\Website\Actions\ContactInformations\ToggleContactInformationAction;
use Modules\Website\Actions\ContactInformations\GetAllContactInformationsAction;
use Modules\Website\Actions\ContactInformations\UpdateContactInformationAction;
use Modules\Website\Entities\ContactInformation;
use Modules\Website\Http\Requests\ContactInformations\StoreContactInformationRequest;
use Modules\Website\Http\Requests\ContactInformations\DeleteContactInformationRequest;
use Modules\Website\Http\Requests\ContactInformations\EditContactInformationRequest;
use Modules\Website\Http\Requests\ContactInformations\ToggleContactInformationRequest;
use Modules\Website\Http\Requests\ContactInformations\UpdateContactInformationRequest;

class ContactInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contact_informations = (new GetAllContactInformationsAction)->handle();
            $total = count($contact_informations);
            return [
                'data' => $contact_informations,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::contact_informations.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::contact_informations.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.contact-informations.store'),
                'types' => ContactInformationType::cases()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreContactInformationRequest $request
     * @param StoreContactInformationAction $action
     * @return Renderable
     */
    public function store(StoreContactInformationRequest $request, StoreContactInformationAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/contact-informations')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/contact-informations')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleContactInformationRequest $request
     * @param ToggleContactInformationAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleContactInformationRequest $toggle_request, ToggleContactInformationAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_contact_information_toggle_was_successfully'),
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
     * @param EditContactInformationRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditContactInformationRequest $request, $id)
    {
        return view('website::contact_informations.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.contact-informations.update', ['id' => $id]),
                'contact_information' => ContactInformation::find($id),
                'types' => ContactInformationType::cases()
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateContactInformationRequest $request
     * @param UpdateContactInformationAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateContactInformationRequest $request, UpdateContactInformationAction $action, $id)
    {
        try {
            $action->handle($request, ContactInformation::find($id));
            return redirect('dashboard/website/contact-informations')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/contact-informations')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteContactInformationRequest $request
     * @param DeleteContactInformationAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteContactInformationRequest $request, DeleteContactInformationAction $action, $id)
    {
        return $action->handle($request);
    }
}
