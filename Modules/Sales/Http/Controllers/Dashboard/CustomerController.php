<?php

namespace Modules\Sales\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\Customer;
use Illuminate\Contracts\Support\Renderable;
use Modules\Sales\Actions\Customers\StoreCustomerAction;
use Modules\Sales\Actions\Customers\DeleteCustomerAction;
use Modules\Sales\Actions\Customers\ToggleCustomerAction;
use Modules\Sales\Actions\Customers\UpdateCustomerAction;
use Modules\Sales\Actions\Customers\GetAllCustomersAction;
use Modules\Sales\Http\Requests\Customers\EditCustomerRequest;
use Modules\Sales\Http\Requests\Customers\StoreCustomerRequest;
use Modules\Sales\Http\Requests\Customers\DeleteCustomerRequest;
use Modules\Sales\Http\Requests\Customers\ToggleCustomerRequest;
use Modules\Sales\Http\Requests\Customers\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $customers = (new GetAllCustomersAction)->handle();
            $customers = $customers->select([
                'id',
                'name',
                'email',
                'phone_number',
                'is_active',
                DB::raw('NULL AS addresses'),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($customers);
            return [
                'data' => $customers,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('sales::customers.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sales::customers.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.sales.customers.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCustomerRequest $request, StoreCustomerAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.customers.index'))->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified customer.
     * @param ToggleCustomerRequest $request
     * @param ToggleCustomerAction $action
     * @return Renderable
     */
    public function toggle(ToggleCustomerRequest $toggleRequest, ToggleCustomerAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status'  => 'success',
                'message' => __('sales::dashboard.the_cusotmer_toggle_was_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditCustomerRequest $request
     * @return Renderable
     */
    public function edit(EditCustomerRequest $request)
    {
        return view('sales::customers.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.sales.customers.update', [$request->id]),
                'customer' => Customer::find($request->id)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateCustomerRequest $request
     * @param UpdateCustomerAction $action
     */
    public function update(UpdateCustomerRequest $request, UpdateCustomerAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.customers.index'))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteCustomerRequest $request
     * @param DeleteCustomerAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteCustomerRequest $request, DeleteCustomerAction $action)
    {
        return $action->handle($request);
    }
}
