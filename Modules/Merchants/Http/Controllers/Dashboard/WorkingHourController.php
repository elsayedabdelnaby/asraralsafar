<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Entities\WorkingHour;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Actions\WorkingHour\StoreWorkingHourAction;
use Modules\Merchants\Actions\WorkingHour\FilterWorkingHourAction;
use Modules\Merchants\Actions\WorkingHour\DeleteWorkingHoursAction;
use Modules\Merchants\Actions\WorkingHour\ToggleMerchantWorkingHourAction;
use Modules\Merchants\Actions\WorkingHour\UpdateMerchantWorkingHourAction;
use Modules\Merchants\Http\Requests\WorkingHours\DeleteWorkingHoursRequest;
use Modules\Merchants\Http\Requests\WorkingHours\MerchantWorkingHourRequest;
use Modules\Merchants\Http\Requests\WorkingHours\EditMerchantWorkingHourRequest;
use Modules\Merchants\Http\Requests\WorkingHours\StoreMerchantWorkingHourRequest;
use Modules\Merchants\Http\Requests\WorkingHours\CreateMerchantWorkingHourRequest;
use Modules\Merchants\Http\Requests\WorkingHours\ToggleMerchantWorkingHourRequest;
use Modules\Merchants\Http\Requests\WorkingHours\UpdateMerchantWorkingHourRequest;

class WorkingHourController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param MerchantWorkingHourRequest $request
     * @param FilterWorkingHourAction $actions
     * @return Renderable|array
     */
    public function index(MerchantWorkingHourRequest $request, FilterWorkingHourAction $actions): Renderable|array
    {
        if ($request->ajax()) {
            $working_hours = $actions->handle($request);
            $working_hours = $working_hours->select([
                'merchant_working_hours.id',
                'merchant_working_hours.day',
                'merchant_working_hours.from',
                'merchant_working_hours.to',
                'merchant_working_hours.is_active',
                DB::raw('NULL as actions')
            ])->get();

            $total = count($working_hours);

            return [
                'data' => $working_hours,
                'recordTotal' => $total,
                'recordsFiltered' => $total
            ];
        }

        $merchant = Merchant::find($request->merchant_id);

        return view('merchants::working_hours.indexing.index', [
            'merchant' => $merchant,
        ]);
    }

    /**
     * return To Create Merchant-working-hours View
     * @param CreateMerchantWorkingHourRequest $request
     * @return View
     */
    public function create(CreateMerchantWorkingHourRequest $request): View
    {
        return view('merchants::working_hours.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.merchants.working-hours.store', ['merchant_id' => $request->merchant_id]),
                'merchant' => Merchant::find($request->merchant_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMerchantWorkingHourRequest $request
     * @param StoreWorkingHourAction $action
     * @return Renderable|RedirectResponse
     */
    public function store(StoreMerchantWorkingHourRequest $request, StoreWorkingHourAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.working-hours.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.working-hours.index', ['merchant_id' => $request->merchant_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditMerchantWorkingHourRequest $request
     * @return Renderable|View
     */
    public function edit(EditMerchantWorkingHourRequest $request): Renderable|View
    {
        return view('merchants::working_hours.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.merchants.working-hours.update', ['merchant_id' => $request->merchant_id, 'id' => $request->id]),
                'merchant' => Merchant::find($request->merchant_id),
                'merchant_working_hours' => WorkingHour::find($request->id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantWorkingHourRequest $request
     * @param UpdateMerchantWorkingHourAction $action
     * @return Renderable|RedirectResponse
     */
    public function update(UpdateMerchantWorkingHourRequest $request, UpdateMerchantWorkingHourAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.working-hours.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect(route('dashboard.merchants.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant Social
     * @param DeleteWorkingHoursRequest $request
     * @param DeleteWorkingHoursAction $action
     * @return JsonResponse
     */
    public function delete(DeleteWorkingHoursRequest $request, DeleteWorkingHoursAction $action): JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_working_hours_deleted'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Toggle the specified Merchant Social.
     * @param ToggleMerchantWorkingHourRequest $toggle_request
     * @param ToggleMerchantWorkingHourAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleMerchantWorkingHourRequest $toggle_request, ToggleMerchantWorkingHourAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_working_hours_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

}
