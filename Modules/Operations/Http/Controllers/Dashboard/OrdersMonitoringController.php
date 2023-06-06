<?php

namespace Modules\Operations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Operations\Actions\OrdersMonitorIng\AssignDeliveryToOrderAction;
use Modules\Operations\Actions\OrdersMonitorIng\FilterOrdersMonitoringAction;
use Modules\Operations\Actions\OrdersMonitorIng\GetAvailableDeliveryGuysAction;
use Modules\Operations\Actions\OrdersMonitorIng\GetOrderDeliveryLocationAction;
use Modules\Operations\Actions\OrdersMonitorIng\GetOrderDetailsAction;
use Modules\Operations\Actions\OrdersMonitorIng\UpdateOrderChangeStatusAction;
use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderToAssignDeliveryRequest;
use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderValidationRequest;
use Modules\Operations\Http\Requests\OrdersMonitoring\GetAvailableDeliveryGuysRequest;
use Modules\Operations\Http\Requests\OrdersMonitoring\UpdateOrderChangeStatusRequest;
use Modules\Sales\Actions\OrderStatus\GetAllOrderStatusAction;
use Psy\Util\Json;

class OrdersMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ordersMonitorIng = (new FilterOrdersMonitoringAction)->handle($request);
            $ordersMonitorIng = $ordersMonitorIng->select([
                'orders.id',
                'orders.total',
                'orders.payment_method',
                'order_status_translations.name as order_status',
                'order_status.color as order_status_color',
                'merchant_branches_translations.name as branch_name',
                'merchant_translations.name as merchant_name',
                'customer.name as customer_name',
                'delivery.name as delivery_name',
                'delivery.id as delivery_id',
                DB::raw('NULL AS delivery_location'),
                DB::raw('NULL AS order_details'),
                DB::raw('NULL AS actions')
            ])->get();
            $total            = count($ordersMonitorIng);
            return [
                'data'            => $ordersMonitorIng,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
        $order_status = (new GetAllOrderStatusAction())->handle()->select([
            'order_status.id',
            'order_status_translations.name'
        ])->get();
        return view('operations::orders_monitoring.indexing.index', [
            'order_status' => $order_status
        ]);
    }

    /**
     * @param CheckOrderValidationRequest $request
     * @param GetOrderDeliveryLocationAction $action
     * @return void
     */
    public function getDeliveryLocation(CheckOrderValidationRequest $request, GetOrderDeliveryLocationAction $action): JsonResponse
    {
        try {
            $deliveryLocation = $action->handle($request);
            return response()->json([
                'status' => 'success',
                'data'   => $deliveryLocation
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
     * @param CheckOrderValidationRequest $request
     * @param GetOrderDetailsAction $action
     * @return JsonResponse
     */
    public function getOrderDetails(CheckOrderValidationRequest $request, GetOrderDetailsAction $action): JsonResponse
    {
        try {
            $orderDetails = $action->handle($request);
            return response()->json([
                'status' => 'success',
                'data'   => $orderDetails
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
     * @param UpdateOrderChangeStatusRequest $request
     * @param UpdateOrderChangeStatusAction $action
     * @return JsonResponse
     */
    public function updateOrderStatus(UpdateOrderChangeStatusRequest $request, UpdateOrderChangeStatusAction $action): JsonResponse
    {
        try {
            $orderDetails = $action->handle($request);
            return response()->json([
                'status' => 'success',
                'data'   => $orderDetails
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
     * @param GetAvailableDeliveryGuysRequest $request
     * @param GetAvailableDeliveryGuysAction $action
     * @return JsonResponse
     */
    public function getDeliveryGuys(GetAvailableDeliveryGuysRequest $request, GetAvailableDeliveryGuysAction $action): JsonResponse
    {
        try {
            $deliveryGuys = $action->handle($request);
            return response()->json([
                'status' => 'success',
                'data'   => $deliveryGuys
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
     * @param CheckOrderToAssignDeliveryRequest $request
     * @param AssignDeliveryToOrderAction $action
     * @return JsonResponse
     */
    public function assignDelivery(CheckOrderToAssignDeliveryRequest $request, AssignDeliveryToOrderAction $action): JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status' => 'success',
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
