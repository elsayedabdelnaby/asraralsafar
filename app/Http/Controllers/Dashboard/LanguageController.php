<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\LanguageDirections;
use App\Http\Actions\Languages\GetAllActiveLanguages;
use App\Http\Actions\Languages\ToggleLanguage;
use App\Http\Actions\Languages\UpdateLanguage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\EditLanguageRequest;
use App\Http\Requests\Languages\StoreLanguageRequest;
use App\Http\Actions\Languages\StoreLanguage;
use App\Http\Requests\Languages\ToggleLanguageRequest;
use App\Http\Requests\Languages\UpdateLanguageRequest;
use App\Models\Language;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable|array
     */
    public function index(Request $request): Renderable|array
    {
        if ($request->ajax()) {
            $languages = (new GetAllActiveLanguages())->handle();
            $total = count($languages);
            return [
                'data' => $languages,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('dashboard.languages.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('dashboard.languages.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.languages.store'),
                'directions' => LanguageDirections::cases(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreLanguageRequest $request
     * @param StoreLanguage $action
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreLanguageRequest $request, StoreLanguage $action): Redirector|RedirectResponse|Application
    {
        try {
            $action->handle($request);
            return redirect('dashboard/languages')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/languages')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified Tag.
     * @param ToggleLanguageRequest $toggle_request
     * @param ToggleLanguage $action
     * @return JsonResponse
     */
    public function toggle(ToggleLanguageRequest $toggle_request, ToggleLanguage $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('dashboard.the_language_toggle_was_successfully'),
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
     * @return Renderable
     */
    public function edit(EditLanguageRequest $request): Renderable
    {
        return view('dashboard.languages.creating_editing.form')
            ->with([
                'method' => 'put',
                'action' => route('dashboard.languages.update', ['id' => $request->id]),
                'directions' => LanguageDirections::cases(),
                'language' => Language::whereId($request->id)->active()->first()
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateLanguageRequest $request
     * @param UpdateLanguage $action
     * @return Renderable|RedirectResponse
     * @throws \Throwable
     */
    public function update(UpdateLanguageRequest $request, UpdateLanguage $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect('dashboard/languages')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/languages')->with(
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
