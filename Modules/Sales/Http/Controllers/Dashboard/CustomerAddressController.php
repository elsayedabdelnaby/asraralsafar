<?php

namespace Modules\Sales\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\Customer;
use Illuminate\Contracts\Support\Renderable;
use Modules\Sales\Services\CustomerAddressService;
use Modules\Sales\Actions\CustomerAddresses\StoreCustomerAddressAction;
use Modules\Sales\Actions\CustomerAddresses\DeleteCustomerAddressAction;
use Modules\Sales\Actions\CustomerAddresses\ToggleCustomerAddressAction;
use Modules\Sales\Actions\CustomerAddresses\UpdateCustomerAddressAction;
use Modules\Sales\Actions\CustomerAddresses\FilterCustomerAddressesAction;
use Modules\Sales\Http\Requests\CustomerAddresses\EditCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\StoreCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\CreateCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\DeleteCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\ToggleCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\UpdateCustomerAddressRequest;
use Modules\Sales\Http\Requests\CustomerAddresses\IndexCustomerAddressesRequest;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param IndexCustomerAddressesRequest $request
     * @return Renderable
     */
    public function index(IndexCustomerAddressesRequest $request)
    {
        if ($request->ajax()) {
            $customerAddresses = (new FilterCustomerAddressesAction())->handle($request);
            $customerAddresses = $customerAddresses->select([
                "customer_addresses.id",
                "city_translations.name AS city",
                "customer_addresses.phone_number",
                "customer_addresses.address",
                "customer_addresses.build_no",
                "customer_addresses.floor_no",
                "customer_addresses.apartment_no",
                "customer_addresses.is_default",
                "customer_addresses.customer_id",
                DB::raw('NULL AS actions'),
            ])->get();

            $total = count($customerAddresses);

            return [
                "data"            => $customerAddresses,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('sales::customer_addresses.indexing.index')->with([
            'customer_id' => $request->get('customer_id'),
            'customer'    => Customer::findOrFail($request->get('customer_id'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(CreateCustomerAddressRequest $request)
    {
        return view('sales::customer_addresses.creating_editing.form')
            ->with((new CustomerAddressService())->prepareAttributesToCreate($request));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCustomerAddressRequest $request
     * @param StoreCustomerAddressAction $action
     * @return Renderable
     */
    public function store(StoreCustomerAddressRequest $request, StoreCustomerAddressAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.customer-addresses.index', ['customer_id' => $request->customer_id]))->with(
                'success',
                __('dashboard.created_successfully')
            );
        }
        catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditCustomerAddressRequest $request
     * @return Renderable
     */
    public function edit(EditCustomerAddressRequest $request)
    {
          return view('sales::customer_addresses.creating_editing.form')
              ->with((new CustomerAddressService())->prepareAttributesToUpdate($request));
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateCustomerAddressRequest $request
     * @param UpdateCustomerAddressAction $action
     */
    public function update(UpdateCustomerAddressRequest $request, UpdateCustomerAddressAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.customer-addresses.index', ['customer_id' => $request->customer_id]))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        }
        catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }



    /**
     * Toggle the specified category.
     * @param DeleteCustomerAddressRequest $request
     * @param DeleteCustomerAddressAction $action
     * @return Renderable
     */
    public function delete(DeleteCustomerAddressRequest $request, DeleteCustomerAddressAction $action)
    {
        try {
            $action->handle($request);
            return response()->json([
                'status'  => 'success',
                'message' => __('sales::dashboard.the_customer_address_delete'),
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
     * Toggle the specified category.
     * @param ToggleCustomerAddressRequest $request
     * @param ToggleCustomerAddressAction $action
     * @return Renderable
     */
    public function toggle(ToggleCustomerAddressRequest $toggle_request, ToggleCustomerAddressAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json([
                'status'  => 'success',
                'message' => __('sales::dashboard.the_customer_address_toggle_was_successfully'),
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
