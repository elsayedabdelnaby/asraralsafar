<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Actions\DeliveryFees\DeleteDeliveryFeeAction;
use Modules\Merchants\Actions\DeliveryFees\FilterDeliveryFeeActions;
use Modules\Merchants\Actions\DeliveryFees\StoreDeliveryFeeAction;
use Modules\Merchants\Actions\DeliveryFees\UpdateDeliveryFeeAction;
use Modules\Merchants\Entities\Merchant;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Entities\MerchantDeliveryFee;
use Modules\Merchants\Http\Requests\DeliveryFees\DeleteDeliveryFeesRequest;
use Modules\Merchants\Http\Requests\DeliveryFees\EditDeliveryFeesRequest;
use Modules\Merchants\Http\Requests\DeliveryFees\StoreDeliveryFeesRequest;
use Modules\Merchants\Http\Requests\DeliveryFees\UpdateDeliveryFeesRequest;

class DeliveryFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $delivery_fees = (new FilterDeliveryFeeActions())->handle($request);

            $delivery_fees = $delivery_fees->select([
                'merchant_delivery_fees.id',
                'merchant_delivery_fees.from',
                'merchant_delivery_fees.to',
                'merchant_delivery_fees.fees',
                DB::raw('NULL as actions')
            ])->get();

            $total = count($delivery_fees);

            return [
                'data'            => $delivery_fees,
                'recordTotal'     => $total,
                'recordsFiltered' => $total
            ];
        }

        $merchant = Merchant::find($request->merchant_id);

        return view('merchants::delivery_fees.indexing.index', [
            'merchant' => $merchant,
        ]);
    }

    /**
     * return To Create Merchant-Delivery-fees  View
     */
    public function create(Request $request)
    {
        return view('merchants::delivery_fees.creating_editing.form')
            ->with([
                'method'   => 'POST',
                'action'   => route('dashboard.merchants.merchant-fees.store', ['merchant_id' => $request->merchant_id]),
                'merchant' => Merchant::find($request->merchant_id),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreDeliveryFeesRequest $request
     * @param StoreDeliveryFeeAction $action
     * @return Renderable
     */
    public function store(StoreDeliveryFeesRequest $request, StoreDeliveryFeeAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.merchant-fees.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.merchants.merchant-fees.index', ['merchant_id' => $request->merchant_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditDeliveryFeesRequest $request
     * @return Renderable
     */
    public function edit(EditDeliveryFeesRequest $request)
    {
        return view('merchants::delivery_fees.creating_editing.form')
            ->with([
                'method'=> 'PUT',
                'action'=> route('dashboard.merchants.merchant-fees.update', ['merchant_id' => $request->merchant_id, 'id' => $request->id]),
                'merchant'=> Merchant::find($request->merchant_id),
                'merchant_delivery_fees' => MerchantDeliveryFee::find($request->id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateDeliveryFeesRequest $request
     * @param UpdateDeliveryFeeAction $action
     * @return Renderable
     */
    public function update(UpdateDeliveryFeesRequest $request, UpdateDeliveryFeeAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.merchant-fees.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.merchants.index'))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant Social
     * @param DeleteDeliveryFeesRequest $request
     * @param DeleteDeliveryFeeAction $action
     * @return Renderable
     */
    public function delete(DeleteDeliveryFeesRequest $request, DeleteDeliveryFeeAction $action)
    {
        try {
            $action->handle($request);
            return response()->json([
                'status'  => 'success',
                'message' => __('merchants::dashboard.the_merchant_delivery_f_deleted'),
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
