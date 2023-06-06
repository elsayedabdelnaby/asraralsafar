<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\SocialLink;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\SocialLinks\StoreSocialLinkAction;
use Modules\Website\Actions\SocialLinks\DeleteSocialLinkAction;
use Modules\Website\Actions\SocialLinks\ToggleSocialLinkAction;
use Modules\Website\Actions\SocialLinks\UpdateSocialLinkAction;
use Modules\Website\Actions\SocialLinks\GetAllSocialLinksAction;
use Modules\Website\Http\Requests\SocialLinks\EditSocialLinkRequest;
use Modules\Website\Http\Requests\SocialLinks\StoreSocialLinkRequest;
use Modules\Website\Http\Requests\SocialLinks\DeleteSocialLinkRequest;
use Modules\Website\Http\Requests\SocialLinks\ToggleSocialLinkRequest;
use Modules\Website\Http\Requests\SocialLinks\UpdateSocialLinkRequest;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $social_links = (new GetAllSocialLinksAction)->handle();
            $total = count($social_links);
            return [
                'data' => $social_links,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::social_links.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::social_links.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.social-links.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSocialLinkRequest $request
     * @param StoreSocialLinkAction $action
     * @return Renderable
     */
    public function store(StoreSocialLinkRequest $request, StoreSocialLinkAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/social-links')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/social-links')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleSocialLinkRequest $request
     * @param ToggleSocialLinkAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleSocialLinkRequest $toggle_request, ToggleSocialLinkAction $action, int $id)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_social_link_toggle_was_successfully'),
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
     * @param EditSocialLinkRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(EditSocialLinkRequest $request, $id)
    {
        return view('website::social_links.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.social-links.update', ['id' => $id]),
                'social_link' => SocialLink::find($id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSocialLinkRequest $request
     * @param UpdateSocialLinkAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateSocialLinkRequest $request, UpdateSocialLinkAction $action, $id)
    {
        try {
            $action->handle($request, SocialLink::find($id));
            return redirect('dashboard/website/social-links')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/social-links')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteSocialLinkRequest $request
     * @param DeleteSocialLinkAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteSocialLinkRequest $request, DeleteSocialLinkAction $action, $id)
    {
        return $action->handle($request);
    }
}
