<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Modules\Merchants\Entities\Merchant;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Entities\MerchantSocial;
use Modules\Merchants\Actions\Social\StoreMerchantSocialAction;
use Modules\Merchants\Actions\Social\FilterMerchantSocialsAction;
use Modules\Merchants\Actions\Social\ToggleMerchantSocialAction;
use Modules\Merchants\Actions\Social\UpdateMerchantSocialAction;
use Modules\Merchants\Http\Requests\Social\MerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\DeleteMerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\StoreMerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\EditMerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\CreateMerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\ToggleMerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\UpdateMerchantSocialRequest;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param MerchantSocialRequest $request
     * @return Renderable|array
     */
    public function index(MerchantSocialRequest $request): Renderable|array
    {
        if ($request->ajax()) {
            $social = (new FilterMerchantSocialsAction())->handle($request);
            $social = $social->select([
                'merchant_social.id',
                'merchant_social.url',
                'merchant_social.display',
                'merchant_social.icon',
                'merchant_social.is_active',
                DB::raw('NULL as actions')
            ])->get();

            $total = count($social);

            return [
                'data' => $social,
                'recordTotal' => $total,
                'recordsFiltered' => $total
            ];
        }

        $merchant = Merchant::find($request->merchant_id);
        return view('merchants::social.indexing.index', [
            'merchant' => $merchant,
        ]);
    }

    /**
     * @param CreateMerchantSocialRequest $request
     * @param $merchant_type
     * @return View
     */
    public function create(CreateMerchantSocialRequest $request, $merchant_type): View
    {
        return view('merchants::social.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.merchants.social.store', ['merchant_id' => $request->merchant_id, 'merchant_type' => $merchant_type]),
                'merchant' => Merchant::find($request->merchant_id),
                'merchant_type' => $merchant_type
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMerchantSocialRequest $request
     * @return Renderable|RedirectResponse
     */
    public function store(StoreMerchantSocialRequest $request, StoreMerchantSocialAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.social.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.social.index', ['merchant_id' => $request->merchant_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditMerchantSocialRequest $request
     * @return Renderable
     */
    public function edit(EditMerchantSocialRequest $request): Renderable
    {
        return view('merchants::social.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.merchants.social.update', ['merchant_id' => $request->merchant_id, 'id' => $request->id]),
                'merchant' => Merchant::find($request->merchant_id),
                'merchant_social' => MerchantSocial::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantSocialRequest $request
     * @param UpdateMerchantSocialAction $action
     * @return Renderable|RedirectResponse
     */
    public function update(UpdateMerchantSocialRequest $request, UpdateMerchantSocialAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.social.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.socials.index', ['merchant_id' => $request->merchant_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant Social
     * @param DeleteMerchantSocialRequest $request
     * @return Renderable
     */
    public function delete(DeleteMerchantSocialRequest $request): Renderable|JsonResponse
    {
        MerchantSocial::whereId($request->get('id'))
            ->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Toggle the specified Merchant Social.
     * @param ToggleMerchantSocialRequest $toggle_request
     * @param ToggleMerchantSocialAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleMerchantSocialRequest $toggle_request, ToggleMerchantSocialAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_social__toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
