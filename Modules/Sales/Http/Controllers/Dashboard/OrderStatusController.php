<?php

namespace Modules\Sales\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Actions\OrderStatus\DeleteOrderStatusAction;
use Modules\Sales\Actions\OrderStatus\GetAllOrderStatusAction;
use Modules\Sales\Actions\OrderStatus\StoreOrderRequestAction;
use Modules\Sales\Actions\OrderStatus\ToggleOrderStatusAction;
use Illuminate\Contracts\Support\Renderable;
use Modules\Sales\Actions\OrderStatus\UpdateReorderOrderStatusAction;
use Modules\Sales\Entities\OrderStatus;
use Modules\Sales\Http\Requests\OrderStatus\DeleteOrderStatusRequest;
use Modules\Sales\Http\Requests\OrderStatus\EditOrderStatusRequest;
use Modules\Sales\Http\Requests\OrderStatus\StoreOrderStatusRequest;
use Modules\Sales\Http\Requests\OrderStatus\ToggleOrderStatusRequest;
use Modules\Sales\Http\Requests\OrderStatus\UpdateOrderStatusRequest;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $customers = (new GetAllOrderStatusAction)->handle();
            $customers = $customers->select([
                'order_status.id',
                'order_status_translations.name',
                'order_status.color as color_code',
                'order_status.color',
                'order_status.is_active',
                DB::raw('NULL AS actions'),
            ])->get();
            $total     = count($customers);
            return [
                'data'            => $customers,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('sales::orderStatus.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sales::orderStatus.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.sales.order-status.store'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreOrderStatusRequest $request, StoreOrderRequestAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.order-status.index'))->with(
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
     * Toggle the specified customer.
     * @param ToggleOrderStatusRequest $request
     * @param ToggleOrderStatusAction $action
     * @return Renderable
     */
    public function toggle(ToggleOrderStatusRequest $toggleRequest, ToggleOrderStatusAction $action)
    {
        try {
            $action->handle($toggleRequest);
            return response()->json([
                'status'  => 'success',
                'message' => __('sales::dashboard.the_order_status_toggle_was_successfully'),
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
     * Show the form for editing the specified resource.
     * @param EditOrderStatusRequest $request
     * @return Renderable
     */
    public function edit(EditOrderStatusRequest $request)
    {
        return view('sales::orderStatus.creating_editing.form')
            ->with([
                'method'       => 'PUT',
                'action'       => route('dashboard.sales.order-status.update', [$request->id]),
                'order_status' => OrderStatus::find($request->id)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateOrderStatusRequest $request
     * @param UpdateOrderStatusAction $action
     */
    public function update(UpdateOrderStatusRequest $request, UpdateOrderStatusAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.order-status.index'))->with(
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
     * Remove the specified resource from storage.
     * @param DeleteOrderStatusRequest $request
     * @param DeleteOrderStatusAction $action
     * @param int $id
     * @return Renderable
     */
    public function delete(DeleteOrderStatusRequest $request, DeleteOrderStatusAction $action)
    {
        return $action->handle($request);
    }


    /**
     * @param Request $request
     * @param UpdateReorderOrderStatus $action
     * @return void
     */
    public function updateReorder(Request $request, UpdateReorderOrderStatusAction $action)
    {
        try {
            $action->handle($request);
            return response()->json([
                'status'  => 'success',
                'message' => __('sales::dashboard.the_order_status_re_order_was_successfully'),
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
