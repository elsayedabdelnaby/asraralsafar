<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\AboutUs;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\AboutUs\DeleteAboutUsAction;
use Modules\Website\Actions\AboutUs\GetAllAboutUsAction;
use Modules\Website\Actions\AboutUs\StoreAboutUsAction;
use Modules\Website\Actions\AboutUs\ToggleAboutUsAction;
use Modules\Website\Actions\AboutUs\UpdateAboutUsAction;
use Modules\Website\Http\Requests\AboutUs\DeleteAboutUsRequest;
use Modules\Website\Http\Requests\AboutUs\EditAboutUsRequest;
use Modules\Website\Http\Requests\AboutUs\StoreAboutUsRequest;
use Modules\Website\Http\Requests\AboutUs\ToggleAboutUsRequest;
use Modules\Website\Http\Requests\AboutUs\UpdateAboutUsRequest;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $aboutUs = (new GetAllAboutUsAction)->handle();
            $total = count($aboutUs);
            return [
                'data' => $aboutUs,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::aboutus.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::aboutus.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.about-us.store')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreAboutUsRequest $request
     * @param StoreAboutUsAction $action
     * @return Renderable
     */
    public function store(StoreAboutUsRequest $request, StoreAboutUsAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/about-us')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/about-us')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleAboutUsRequest $request
     * @param ToggleAboutUsAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleAboutUsRequest $toggle_request, ToggleAboutUsAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_about_us_toggle_was_successfully'),
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
     * @param EditAboutUsRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditAboutUsRequest $request, $id)
    {
        return view('website::aboutus.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.about-us.update', ['id' => $id]),
                'about_us' => AboutUs::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateAboutUsRequest $request
     * @param UpdateAboutUsAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateAboutUsRequest $request, UpdateAboutUsAction $action, $id)
    {
        try {
            $action->handle($request, AboutUs::findOrFail($id));
            return redirect('dashboard/website/about-us')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/about-us')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteAboutUsRequest $request
     * @param DeleteAboutUsAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteAboutUsRequest $request, DeleteAboutUsAction $action, $id)
    {
        return $action->handle($request);
    }
}
