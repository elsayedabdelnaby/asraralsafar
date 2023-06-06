<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\DeliveryFee;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Actions\DeliveryFees\UpdateDeliveryFeesAction;
use Modules\Settings\Actions\DeliveryFees\StoreDeliveryFeesAction;
use Modules\Settings\Actions\DeliveryFees\ToggleDeliveryFeesAction;
use Modules\Settings\Http\Requests\DeliveryFees\DeleteDeliveryFeesRequest;
use Modules\Settings\Http\Requests\DeliveryFees\EditDeliveryFeesRequest;
use Modules\Settings\Http\Requests\DeliveryFees\StoreDeliveryFeesRequest;
use Modules\Settings\Http\Requests\DeliveryFees\ToggleDeliveryFeesRequest;
use Modules\Settings\Http\Requests\DeliveryFees\UpdateDeliveryFeesRequest;

class DeliveryFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request): Renderable|array
    {
        if ($request->ajax()) {
            $deliveryFees = DeliveryFee::select([
                'id',
                'from',
                'to',
                'fees',
                'is_active',
                DB::raw('NULL AS actions')
            ])->get();

            $total = count($deliveryFees);
            return [
                'data' => $deliveryFees,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }

        return view('settings::delivery_fees.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('settings::delivery_fees.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.settings.delivery_fees.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreDeliveryFeesRequest $request
     * @param StoreDeliveryFeesAction $action
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreDeliveryFeesRequest $request, StoreDeliveryFeesAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/delivery_fees')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/delivery_fees')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified Tag.
     * @param Request $toggle_request
     * @param ToggleDeliveryFeesAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleDeliveryFeesRequest $request, ToggleDeliveryFeesAction $action)
    {
        try {
            $action->handle($request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('settings::dashboard.the_delivery_fees_toggle_was_successful'),
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
     * @param EditDeliveryFeesRequest $request
     * @return Renderable
     */
    public function edit(EditDeliveryFeesRequest $request): Renderable
    {
        return view('settings::delivery_fees.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.settings.delivery_fees.update', ['id' => $request->id]),
                'delivery_fees' => DeliveryFee::find($request->id),
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateDeliveryFeesRequest $request
     * @param UpdateDeliveryFeesAction $action
     * @return Renderable
     */
    public function update(UpdateDeliveryFeesRequest $request, UpdateDeliveryFeesAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/delivery_fees')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/delivery_fees')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteDeliveryFeesRequest $request
     * @return bool
     */
    public function delete(DeleteDeliveryFeesRequest $request): bool
    {
        $delivery_fees = DeliveryFee::find($request->id);
        return $delivery_fees->delete();
    }
}
