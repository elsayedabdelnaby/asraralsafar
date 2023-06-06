<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Website\Enums\LinkType;
use Modules\Website\Entities\FooterLink;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Footer\Links\StoreFooterLinkAction;
use Modules\Website\Actions\Footer\Links\DeleteFooterLinkAction;
use Modules\Website\Actions\Footer\Links\ToggleFooterLinkAction;
use Modules\Website\Http\Requests\Footer\Links\EditFooterLinkRequest;
use Modules\Website\Http\Requests\Footer\Links\StoreFooterLinkRequest;
use Modules\Website\Http\Requests\Footer\Links\DeleteFooterLinkRequest;
use Modules\Website\Http\Requests\Footer\Links\ToggleFooterLinkRequest;
use Modules\Website\Http\Requests\Footer\Links\UpdateFooterLinkRequest;
use Modules\GeneralSettings\Actions\Footer\Links\UpdateFooterLinkAction;
use Modules\Website\Actions\Footer\Links\GetAllFooterLinksOfFooterSectionAction;
use Modules\Website\Http\Requests\Footer\Links\ValidateFooterSectionByIdRequest;
use Modules\Website\Actions\Footer\Links\UpdateFooterLinkAction as LinksUpdateFooterLinkAction;

class FooterLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param ValidateFooterSectionByIdRequest $request
     * @return Renderable
     */
    public function index(ValidateFooterSectionByIdRequest $request)
    {
        if ($request->ajax()) {
            $footer_links = (new GetAllFooterLinksOfFooterSectionAction)->handle($request->footer_section_id);
            $footer_links = $footer_links->select(
                'footer_links.id',
                'name',
                'type',
                'url',
                'is_active',
                'display_order',
                DB::raw("IF (type = 'internal', CONCAT('" . env('APP_URL') . '/' . "', url), url) AS link"),
                DB::raw('NULL AS actions')
            )->get();
            $total = count($footer_links);
            return [
                'data' => $footer_links,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::footer_links.indexing.index')->with([
            'footer_section_id' => $request->footer_section_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param ValidateFooterSectionByIdRequest $request
     * @return Renderable
     */
    public function create(ValidateFooterSectionByIdRequest $request)
    {
        return view('website::footer_links.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.footer-links.store', ['footer_section_id' => $request->footer_section_id]),
                'footer_section_id' => $request->footer_section_id,
                'types' => LinkType::cases()
            ]);
        return view('website::footer_links.creating_editing.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFooterLinkRequest $request
     * @param StoreFooterLinkAction $action
     * @return Renderable
     */
    public function store(StoreFooterLinkRequest $request, StoreFooterLinkAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/footer-sections/' . $request->footer_section_id . '/footer-links')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/footer-sections/' . $request->footer_section_id . '/footer-links')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified footer link.
     * @param ToggleFooterLinkRequest $request
     * @param ToggleFooterLinkAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleFooterLinkRequest $toggle_request, ToggleFooterLinkAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_footer_link_toggle_was_successfully'),
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
     * @param EditFooterLinkRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditFooterLinkRequest $request)
    {
        return view('website::footer_links.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.footer-links.update', ['footer_section_id' => $request->footer_section_id, 'id' => $request->id]),
                'footer_link' => FooterLink::find($request->id),
                'footer_section_id' => $request->footer_section_id,
                'types' => LinkType::cases()
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFooterLinkRequest $request
     * @param UpdateFooterLinkAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateFooterLinkRequest $request, LinksUpdateFooterLinkAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/footer-sections/' . $request->footer_section_id . '/footer-links')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/footer-sections/' . $request->footer_section_id . '/footer-links')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteFooterLinkRequest $request
     * @param DeleteFooterLinkAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteFooterLinkRequest $request, DeleteFooterLinkAction $action, $id)
    {
        return $action->handle($request);
    }
}
