<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\MainSlider;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\MainSliders\StoreMainSliderAction;
use Modules\Website\Actions\MainSliders\DeleteMainSliderAction;
use Modules\Website\Actions\MainSliders\ToggleMainSliderAction;
use Modules\Website\Actions\MainSliders\UpdateMainSliderAction;
use Modules\Website\Actions\MainSliders\GetAllMainSlidersAction;
use Modules\Website\Http\Requests\MainSliders\EditMainSliderRequest;
use Modules\Website\Http\Requests\MainSliders\StoreMainSliderRequest;
use Modules\Website\Http\Requests\MainSliders\DeleteMainSliderRequest;
use Modules\Website\Http\Requests\MainSliders\ToggleMainSliderRequest;
use Modules\Website\Http\Requests\MainSliders\UpdateMainSliderRequest;

class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $main_sliders = (new GetAllMainSlidersAction)->handle();
            $total = count($main_sliders);
            return [
                'data' => $main_sliders,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::main_sliders.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::main_sliders.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.main-sliders.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMainSliderRequest $request
     * @param StoreMainSliderAction $action
     * @return Renderable
     */
    public function store(StoreMainSliderRequest $request, StoreMainSliderAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/main-sliders')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/main-sliders')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified footer link.
     * @param ToggleMainSliderRequest $request
     * @param ToggleMainSliderAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleMainSliderRequest $toggle_request, ToggleMainSliderAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_main_slider_toggle_was_successfully'),
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
     * @param EditMainSliderRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditMainSliderRequest $request)
    {
        return view('website::main_sliders.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.main-sliders.update', ['id' => $request->id]),
                'main_slider' => MainSlider::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMainSliderRequest $request
     * @param UpdateMainSliderAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateMainSliderRequest $request, UpdateMainSliderAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/main-sliders')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/main-sliders')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteMainSliderRequest $request
     * @param DeleteMainSliderAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteMainSliderRequest $request, DeleteMainSliderAction $action, $id)
    {
        return $action->handle($request);
    }
}
