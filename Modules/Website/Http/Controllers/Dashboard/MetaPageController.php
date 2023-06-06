<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Enums\PageName;
use Modules\Website\Entities\MetaPage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\MetaPages\StoreMetaPageAction;
use Modules\Website\Actions\MetaPages\DeleteMetaPageAction;
use Modules\Website\Actions\MetaPages\UpdateMetaPageAction;
use Modules\Website\Actions\MetaPages\GetAllMetaPagesAction;
use Modules\Website\Http\Requests\MetaPages\EditMetaPageRequest;
use Modules\Website\Actions\MetaPages\GetAllUnsetMetaPagesAction;
use Modules\Website\Http\Requests\MetaPages\StoreMetaPageRequest;
use Modules\Website\Http\Requests\MetaPages\DeleteMetaPageRequest;
use Modules\Website\Http\Requests\MetaPages\UpdateMetaPageRequest;

class MetaPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $meta_pages = (new GetAllMetaPagesAction)->handle();
            $total = count($meta_pages);
            return [
                'data' => $meta_pages,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::meta_pages.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::meta_pages.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.meta-pages.store'),
                'pages' => GetAllUnsetMetaPagesAction::get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMetaPageRequest $request
     * @param StoreMetaPageAction $action
     * @return Renderable
     */
    public function store(StoreMetaPageRequest $request, StoreMetaPageAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/meta-pages')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/meta-pages')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditMetaPageRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditMetaPageRequest $request, $id)
    {
        $unset_pages = GetAllUnsetMetaPagesAction::get();
        $meta_page = MetaPage::find($id);
        $unset_pages[] = PageName::from($meta_page->page);

        return view('website::meta_pages.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.meta-pages.update', ['id' => $id]),
                'meta_page' => $meta_page,
                'pages' => $unset_pages
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMetaPageRequest $request
     * @param UpdateMetaPageAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateMetaPageRequest $request, UpdateMetaPageAction $action, $id)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/meta-pages')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/meta-pages')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteMetaPageRequest $request
     * @param DeleteMetaPageAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteMetaPageRequest $request, DeleteMetaPageAction $action, $id)
    {
        return $action->handle($request);
    }
}
