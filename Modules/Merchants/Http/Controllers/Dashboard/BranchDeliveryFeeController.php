<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Merchants\Actions\BranchDeliveryFees\DeleteBranchDeliveryFeeAction;
use Modules\Merchants\Actions\BranchDeliveryFees\FilterBranchDeliveryFeeActions;
use Modules\Merchants\Actions\BranchDeliveryFees\StoreBranchDeliveryFeeAction;
use Modules\Merchants\Actions\BranchDeliveryFees\UpdateBranchDeliveryFeeAction;
use Modules\Merchants\Entities\Merchant;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Entities\MerchantBranchDeliveryFee;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\DeleteBranchDeliveryFeesRequest;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\EditBranchDeliveryFeesRequest;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\StoreBranchDeliveryFeesRequest;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\UpdateBranchDeliveryFeesRequest;

class BranchDeliveryFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $delivery_fees = (new FilterBranchDeliveryFeeActions())->handle($request);

            $delivery_fees = $delivery_fees->select([
                'merchant_branch_delivery_fees.id',
                'merchant_branch_delivery_fees.from',
                'merchant_branch_delivery_fees.to',
                'merchant_branch_delivery_fees.fees',
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
        $merchantBranch = MerchantBranch::find($request->branch_id);

        return view('merchants::delivery_branch_fees.indexing.index', [
            'merchant' => $merchant,
            'merchantBranch'=>$merchantBranch
        ]);
    }

    /**
     * return To Create Merchant-Delivery-fees  View
     */
    public function create(Request $request)
    {
        return view('merchants::delivery_branch_fees.creating_editing.form')
            ->with([
                'method'   => 'POST',
                'action'   => route('dashboard.merchants.branch-fees.store', ['merchant_id' => $request->merchant_id,'branch_id'=>$request->branch_id]),
                'merchant' => Merchant::find($request->merchant_id),
                'merchantBranch'=>MerchantBranch::find($request->branch_id)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBranchDeliveryFeesRequest $request
     * @param StoreBranchDeliveryFeeAction $action
     * @return Renderable
     */
    public function store(StoreBranchDeliveryFeesRequest $request, StoreBranchDeliveryFeeAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.branch-fees.index', ['merchant_id' => $request->merchant_id,'branch_id'=>$request->branch_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.merchants.branch-fees.index', ['merchant_id' => $request->merchant_id,'branch_id'=>$request->branch_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditBranchDeliveryFeesRequest $request
     * @return Renderable
     */
    public function edit(EditBranchDeliveryFeesRequest $request)
    {
        return view('merchants::delivery_branch_fees.creating_editing.form')
            ->with([
                'method'=> 'PUT',
                'action'=> route('dashboard.merchants.branch-fees.update', ['branch_id'=>$request->branch_id,'merchant_id' => $request->merchant_id, 'id' => $request->id]),
                'merchant'=> Merchant::find($request->merchant_id),
                'merchantBranch'=>MerchantBranch::find($request->branch_id),
                'merchant_branch_delivery_fees' => MerchantBranchDeliveryFee::find($request->id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBranchDeliveryFeesRequest $request
     * @param UpdateBranchDeliveryFeeAction $action
     * @return Renderable
     */
    public function update(UpdateBranchDeliveryFeesRequest $request, UpdateBranchDeliveryFeeAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.branch-fees.index', ['merchant_id' => $request->merchant_id,'branch_id'=>$request->branch_id]))->with(
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
     * @param int $id
     * @return Renderable
     */
    public function delete(DeleteBranchDeliveryFeesRequest $request, DeleteBranchDeliveryFeeAction $action)
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
