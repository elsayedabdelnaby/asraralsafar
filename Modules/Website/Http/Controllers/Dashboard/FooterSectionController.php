<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\FooterSection;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Footer\Sections\StoreFooterSectionAction;
use Modules\Website\Actions\Footer\Sections\DeleteFooterSectionAction;
use Modules\Website\Actions\Footer\Sections\ToggleFooterSectionAction;
use Modules\Website\Actions\Footer\Sections\UpdateFooterSectionAction;
use Modules\Website\Actions\Footer\Sections\GetAllFooterSectionsAction;
use Modules\Website\Http\Requests\Footer\Sections\EditFooterSectionRequest;
use Modules\Website\Http\Requests\Footer\Sections\StoreFooterSectionRequest;
use Modules\Website\Http\Requests\Footer\Sections\DeleteFooterSectionRequest;
use Modules\Website\Http\Requests\Footer\Sections\ToggleFooterSectionRequest;
use Modules\Website\Http\Requests\Footer\Sections\UpdateFooterSectionRequest;

class FooterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $links_url = route('dashboard.website.footer-links.index', ['footer_section_id' => 'footer_section_id']);
            $footer_sections = (new GetAllFooterSectionsAction)->handle();
            $footer_sections = $footer_sections->select(
                'footer_sections.id',
                'name',
                'is_active',
                'display_order',
                DB::raw("REPLACE('" . $links_url . "', 'footer_section_id', footer_sections.id) AS links"),
                DB::raw('NULL AS actions')
            )->get();
            $total = count($footer_sections);
            return [
                'data' => $footer_sections,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::footer_sections.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::footer_sections.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.footer-sections.store')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreFooterSectionRequest $request
     * @param StoreFooterSectionAction $action
     * @return Renderable
     */
    public function store(StoreFooterSectionRequest $request, StoreFooterSectionAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/footer-sections')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/footer-sections')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified footer section.
     * @param ToggleFooterSectionRequest $request
     * @param ToggleFooterSectionAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleFooterSectionRequest $toggle_request, ToggleFooterSectionAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_footer_section_toggle_was_successfully'),
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
     * @param EditFooterSectionRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditFooterSectionRequest $request, $id)
    {
        return view('website::footer_sections.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.footer-sections.update', ['id' => $id]),
                'footer_section' => FooterSection::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFooterSectionRequest $request
     * @param UpdateFooterSectionAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateFooterSectionRequest $request, UpdateFooterSectionAction $action, $id)
    {
        try {
            $action->handle($request, FooterSection::find($id));
            return redirect('dashboard/website/footer-sections')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/footer-sections')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteFooterSectionRequest $request
     * @param DeleteFooterSectionAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteFooterSectionRequest $request, DeleteFooterSectionAction $action, $id)
    {
        return $action->handle($request);
    }
}
