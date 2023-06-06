<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use \Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Modules\Merchants\Actions\Merchant\UpdateMerchantAction;
use Modules\Merchants\Actions\MerchantBranch\StoreMerchantBranchAction;
use Modules\Merchants\Actions\MerchantBranch\StoreMerchantBranchWithManagerAction;
use Modules\Merchants\Actions\MerchantBranch\UpdateMerchantWithManagerAction;
use Modules\Merchants\Entities\Merchant;
use Illuminate\Contracts\Foundation\Application;
use Modules\Locations\Actions\Countries\GetAllCountries;
use Modules\Merchants\Actions\MerchantBranch\DeleteMerchantBranchAction;
use Modules\Merchants\Actions\MerchantBranch\FilterMerchantBranchActions;
use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Http\Requests\MerchantBranch\EditMerchantBranchRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\MerchantBranchRequest;
use Modules\Merchants\Actions\MerchantBranch\ToggleMerchantBranchHourAction;
use Modules\Merchants\Http\Requests\MerchantBranch\DeleteMerchantBranchRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchWithManagerRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\ToggleMerchantBranchFeeRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\UpdateMerchantBranchWithManagerRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\UpdateMerchantBranchWithRequest;
use Modules\UsersManagement\Actions\Users\GetAllMerchantManager;

class BranchController extends Controller
{

    /**
     * @param MerchantBranchRequest $request
     * @param FilterMerchantBranchActions $filterMerchantsBranchAction
     * @return array|Application|Factory|View
     */
    public function index(MerchantBranchRequest $request, FilterMerchantBranchActions $filterMerchantsBranchAction)
    {
        if ($request->ajax()) {
            $merchantBranch = $filterMerchantsBranchAction->handle($request);

            $merchantBranch = $merchantBranch->select([
                'merchant_branches.id',
                'merchant_branches_translations.name',
                'merchant_branches_translations.address',
                'merchant_branches.latitude',
                'merchant_branches.longitude',
                'city_translations.name as city_name',
                'merchant_branches.is_active',
                DB::raw('NULL as actions'),
                DB::raw('NULL as merchants_delivery_fee'),
                DB::raw('NULL as location'),
                DB::raw('NULL as merchant_branch_delivery_fee'),
            ])->get();

            $total = count($merchantBranch);

            return [
                'data'            => $merchantBranch,
                'recordTotal'     => $total,
                'recordsFiltered' => $total
            ];
        }

        $merchant = Merchant::find($request->merchant_id);
        return view('merchants::merchant_branches.indexing.index', [
            'countries' => (new GetAllCountries())->handle()->get(),
            'merchant'  => $merchant
        ]);
    }

    /**
     * return To Create Merchant View
     */
    public function create(Request $request)
    {
        $merchant = Merchant::find($request->merchant_id);
        return view('merchants::merchant_branches.creating_editing.form')
            ->with([
                'method'            => 'POST',
                'action'            => route('dashboard.merchants.branches.store', ['merchant_id' => $request->merchant_id]),
                'countries'         => (new GetAllCountries())->handle()->get(),
                'merchant'          => $merchant,
                'merchant_managers' => (new GetAllMerchantManager())->handle($merchant->owner_id)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMerchantBranchRequest $request Request $request
     * @param StoreMerchantBranchAction $action
     */
    public function store(StoreMerchantBranchWithManagerRequest $request, StoreMerchantBranchWithManagerAction $storeMerchantActionAction)
    {
        try {
            $storeMerchantActionAction->handle($request);
            return redirect(route('dashboard.merchants.branches.index', ['merchant_id' => $request->merchant_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.merchants.branches.index', ['merchant_id' => $request->merchant_id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /*** Show the form for editing the specified resource.
     * @param EditMerchantBranchRequest $request
     */
    public function edit(EditMerchantBranchRequest $request)
    {
        $merchant = Merchant::find($request->merchant_id);
        return view('merchants::merchant_branches.creating_editing.form')
            ->with([
                'method'=> 'PUT',
                'action'=> route('dashboard.merchants.branches.update', ['merchant_id' => $request->merchant_id,'id'=>$request->id]),
                'countries'=> (new GetAllCountries())->handle()->get(),
                'merchant'=> $merchant,
                'merchant_managers' => (new GetAllMerchantManager())->handle($merchant->owner_id),
                'merchant_branch'=>MerchantBranch::find($request->id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantBranchWithManagerRequest $request
     * @param UpdateMerchantWithManagerAction $action
     */
    public function update(UpdateMerchantBranchWithManagerRequest $request, UpdateMerchantWithManagerAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.merchants.branches.index',['merchant_id' => $request->merchant_id,'id'=>$request->id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        }
        catch (Exception $e) {
           return redirect(route('dashboard.merchants.branches.index',['merchant_id' => $request->merchant_id,'id'=>$request->id]))->with(
                'error',
                $e->getMessage()
            );
        }
    }


    /**
     * Toggle the specified Merchant Social.
     * @param ToggleMerchantBranchFeeRequest $toggle_request
     * @param ToggleMerchantBranchHourAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleMerchantBranchFeeRequest $toggle_request, ToggleMerchantBranchHourAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status'  => 'success',
                'message' => __('merchants::dashboard.the_merchant_working_hours_was_successfully'),
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form to select the profile which will replace by the deleted Merchant Social
     * @param DeleteMerchantBranchRequest $request
     * @param DeleteMerchantBranchAction $action
     * @return JsonResponse
     */
    public function delete(DeleteMerchantBranchRequest $request, DeleteMerchantBranchAction $action)
    {
        try {
            $action->handle($request);
            return response()->json([
                'status'  => 'success',
                'message' => __('merchants::dashboard.the_merchant_branch_deleted'),
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
