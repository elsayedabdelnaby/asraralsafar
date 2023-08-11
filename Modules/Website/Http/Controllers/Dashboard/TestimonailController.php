<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Modules\Website\Entities\Testimonail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Testimonails\StoreTestimonailAction;
use Modules\Website\Actions\Testimonails\DeleteTestimonailAction;
use Modules\Website\Actions\Testimonails\ToggleTestimonailAction;
use Modules\Website\Actions\Testimonails\UpdateTestimonailAction;
use Modules\Website\Actions\Testimonails\GetAllTestimonailsAction;
use Modules\Website\Http\Requests\Testimonails\EditTestimonailRequest;
use Modules\Website\Http\Requests\Testimonails\StoreTestimonailRequest;
use Modules\Website\Http\Requests\Testimonails\DeleteTestimonailRequest;
use Modules\Website\Http\Requests\Testimonails\ToggleTestimonailRequest;
use Modules\Website\Http\Requests\Testimonails\UpdateTestimonailRequest;

class TestimonailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $testimonails = (new GetAllTestimonailsAction)->handle();
            $testimonails = $testimonails->select([
                'testimonails.id',
                'client_name',
                'testimonail',
                'display_order',
                'is_active',
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($testimonails);
            return [
                'data' => $testimonails,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::testimonails.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('website::testimonails.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.testimonails.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTestimonailRequest $request
     * @param StoreTestimonailAction $action
     * @return Renderable
     */
    public function store(StoreTestimonailRequest $request, StoreTestimonailAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/testimonails')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/testimonails')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleTestimonailRequest $request
     * @param ToggleTestimonailAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleTestimonailRequest $toggle_request, ToggleTestimonailAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_testimonail_toggle_was_successfully'),
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
     * @param EditTestimonailRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditTestimonailRequest $request)
    {
        return view('website::testimonails.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.testimonails.update', ['id' => $request->id]),
                'testimonail' => Testimonail::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTestimonailRequest $request
     * @param UpdateTestimonailAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateTestimonailRequest $request, UpdateTestimonailAction $action)
    {
        try {
            $action->handle($request, Testimonail::findOrFail($request->id));
            return redirect('dashboard/website/testimonails')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/testimonails')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteTestimonailRequest $request
     * @param DeleteTestimonailAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteTestimonailRequest $request, DeleteTestimonailAction $action)
    {
        return $action->handle($request);
    }
}
