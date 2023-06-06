<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\Tag;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Actions\Tags\StoreTagAction;
use Modules\Settings\Actions\Tags\DeleteTagAction;
use Modules\Settings\Actions\Tags\ToggleTagAction;
use Modules\Settings\Actions\Tags\UpdateTagAction;
use Modules\Settings\Actions\Tags\GetAllActiveTags;
use Modules\Settings\Http\Requests\Tags\EditTagRequest;
use Modules\Settings\Http\Requests\Tags\StoreTagRequest;
use Modules\Settings\Http\Requests\Tags\DeleteTagRequest;
use Modules\Settings\Http\Requests\Tags\ToggleTagRequest;
use Modules\Settings\Http\Requests\Tags\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tags = (new GetAllActiveTags)->handle($request);
            $tags = $tags->select([
                'tags.id',
                'tag_translations.name',
                'is_active',
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($tags);
            return [
                'data' => $tags,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('settings::tags.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::tags.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.settings.tags.store')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTagRequest $request
     * @param StoreTagAction $action
     * @return Renderable
     */
    public function store(StoreTagRequest $request, StoreTagAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/tags')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/tags')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified Tag.
     * @param ToggleTagRequest $request
     * @param ToggleTagAction $action
     * @return Renderable
     */
    public function toggle(ToggleTagRequest $toggle_request, ToggleTagAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('settings::dashboard.the_tag_toggle_was_successfully'),
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
     * @param EditTagRequest $request
     * @return Renderable
     */
    public function edit(EditTagRequest $request)
    {
        return view('settings::tags.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.settings.tags.update', ['id' => $request->id]),
                'tag' => Tag::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTagRequest $request
     * @param UpdateTagAction $action
     * @return Renderable
     */
    public function update(UpdateTagRequest $request, UpdateTagAction $action)
    {
        try {
            $action->handle($request, Tag::find($request->id));
            return redirect('dashboard/settings/tags')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/tags')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteTagRequest $request
     * @param DeleteTagAction $action
     * @return Renderable
     */
    public function destroy(DeleteTagRequest $request, DeleteTagAction $action)
    {
        return $action->handle($request);
    }
}
