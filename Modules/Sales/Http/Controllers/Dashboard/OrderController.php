<?php

namespace Modules\Sales\Http\Controllers\Dashboard;

use Exception;
use Modules\Operations\Entities\DeliveryGuyCity;
use Modules\Sales\Actions\Orders\GetAllCustomerAddressesAction;
use Modules\Sales\Actions\Orders\GetAllDeliveryGuysAction;
use Modules\Sales\Actions\OrderStatus\GetAllOrderStatusAction;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Sales\Entities\Order;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Sales\Enums\PaymentMethods;
use Modules\Sales\Entities\CustomerAddress;
use Illuminate\Contracts\Support\Renderable;
use Modules\Merchants\Entities\MerchantBranch;
use Illuminate\Contracts\Foundation\Application;
use Modules\Sales\Actions\Orders\StoreOrderAction;
use Modules\Sales\Actions\Orders\DeleteOrderAction;
use Modules\Sales\Actions\Orders\UpdateOrderAction;
use Modules\Sales\Actions\Orders\GetAllOrdersAction;
use Modules\Merchants\Actions\Product\GetAllProducts;
use Modules\Sales\Actions\Orders\GetAllMerchantsAction;
use Modules\Sales\Http\Requests\Orders\EditOrderRequest;
use Modules\Sales\Http\Requests\Orders\StoreOrderRequest;
use Modules\Sales\Actions\Customers\GetAllCustomersAction;
use Modules\Sales\Http\Requests\Orders\DeleteOrderRequest;
use Modules\Sales\Http\Requests\Orders\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable|array
     */
    public function index(Request $request): Renderable|array
    {
        if ($request->ajax()) {
            $orders = (new GetAllOrdersAction)->handle();
            $total  = count($orders);
            return [
                'data'            => $orders,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('sales::orders.indexing.index');
    }


    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        $order_status = (new GetAllOrderStatusAction())->handle()->select([
            'order_status.id',
            'order_status_translations.name'
        ])->get();

        return view('sales::orders.creating_editing.form')
            ->with([
                'method'          => 'POST',
                'action'          => route('dashboard.sales.orders.store'),
                'products'        => (new GetAllProducts())->handle(),
                'merchants'       => (new GetAllMerchantsAction())->handle(),
                'customers'       => (new GetAllCustomersAction())->handle()->get(),
                'payment_methods' => PaymentMethods::cases(),
                'order_status'    => $order_status
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreOrderRequest $request
     * @param StoreOrderAction $action
     * @return Renderable|RedirectResponse
     */
    public function store(StoreOrderRequest $request, StoreOrderAction $action): Renderable|RedirectResponse
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.orders.index'))
                ->with(
                    'success',
                    __('dashboard.created_successfully')
                );
        }
        catch (Exception $e) {
            return redirect(route('dashboard.sales.orders.index'))
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditOrderRequest $request
     * @return Renderable
     */
    public function edit(EditOrderRequest $request): Renderable
    {
        $order_status = (new GetAllOrderStatusAction())->handle()->select([
            'order_status.id',
            'order_status_translations.name'
        ])->get();

        return view('sales::orders.creating_editing.form')
            ->with([
                'method'          => 'PUT',
                'action'          => route('dashboard.sales.orders.update', ['id' => $request->id]),
                'order'           => self::queryOrderDataByOrderId($request->id),
                'products'        => (new GetAllProducts())->handle(),
                'merchants'       => (new GetAllMerchantsAction())->handle(),
                'addresses'       => (new GetAllCustomerAddressesAction())->handle(),
                'deliveries'      => (new GetAllDeliveryGuysAction())->handle(),
                'payment_methods' => PaymentMethods::cases(),
                'order_status'    => $order_status
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateOrderRequest $request, UpdateOrderAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.sales.orders.index'))
                ->with(
                    'success',
                    __('dashboard.updated_successfully')
                );

        }
        catch (Exception $e) {
            return redirect(route('dashboard.sales.orders.index'))
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    /**
     * @param DeleteOrderRequest $request
     * @param DeleteOrderAction $action
     * @return string
     * @throws Throwable
     */
    public function delete(DeleteOrderRequest $request, DeleteOrderAction $action): string|JsonResponse
    {
        try {
            $action->handle($request);
            return response()->json([
                'status'  => 'success',
                'message' => __('sales::dashboard.the_order_is_deleted'),
            ]);
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @param $customer_id
     * @return array|void
     */
    public function queryCustomerAddressByCustomerId(Request $request, $customer_id)
    {
        if ($request->ajax()) {

            $addresses = CustomerAddress::where('customer_id', $customer_id)
                ->get(['id', 'address']);

            $total = count($addresses);

            return [
                "data"            => $addresses,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
    }

    /**
     * @param Request $request
     * @param $merchant_id
     * @return array|void
     */
    public function queryMerchantBranchByMerchantId(Request $request, $merchant_id)
    {
        if ($request->ajax()) {

            $branches = MerchantBranch::with('translations')
                ->where('merchant_id', $merchant_id)
                ->get()
                ->map(function ($q) {
                    return [
                        'id'   => $q->id,
                        'name' => $q->translations()->where('language_id', 1)->first()->name,
                    ];
                });

            $total = count($branches);

            return [
                "data"            => $branches,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
    }

    /**
     * @param Request $request
     * @param $customer_address_id
     * @return array|void
     */
    public function queryDeliveryGuysBYCustomerAddressId(Request $request, $customer_address_id)
    {
        if ($request->ajax()) {
            $city_id = CustomerAddress::whereId($customer_address_id)
                ->first()
                ->city_id;

            $deliveries = DeliveryGuyCity::with('deliveries')
                ->where('city_id', $city_id)
                ->get()
                ->map(function ($query) {
                    return current($query->deliveries->where('type', 'delivery_guy')
                        ->get()
                        ->map(function ($q) {
                            return [
                                'id'   => $q->id,
                                'name' => $q->name,
                            ];
                        }));
                });

            $total = count($deliveries);

            return [
                "data"            => $deliveries,
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
            ];
        }
    }

    private static function queryOrderDataByOrderId(mixed $id)
    {
        return
            Order::with(['customer', 'address', 'delivery', 'coupon'])
                ->with(['merchantBranch.translations' => function ($q) {
                    $q->where('merchant_branches_translations.language_id', getCurrentLanguage()->id);
                }])
                ->with(['merchantBranch.merchant.translations' => function ($q) {
                    $q->where('merchant_translations.language_id', getCurrentLanguage()->id);
                }])
                ->with(['orderProducts.product.translations' => function ($q) {
                    $q->where('product_translations.language_id', getCurrentLanguage()->id);
                }])
                ->where('orders.id', $id)
                ->get()
                ->map(callback: fn($query) => [
                    'id'              => $query->id,
                    'total'           => $query->total,
                    'payment_method'  => $query->payment_method,
                    'status'          => $query->orderstatus->translations()->first()->name,
                    'order_status_id' => $query->order_status_id,
                    'merchant'        => $query->merchantBranch->merchant->translations->first()->name,
                    'branch'          => $query->merchantBranch->translations->first()->name,
                    'customer'        => [
                        'id'   => $query->customer->id,
                        'name' => $query->customer->name,
                    ],
                    'address'         => [
                        'id'      => $query->address->id,
                        'address' => $query->address->address,
                    ],
                    'delivery'        => [
                        'id'   => $query->delivery->id,
                        'name' => $query->delivery->name,
                    ],
                    'coupon'          => $query->coupon
                        ?
                        [
                            'id'   => $query->coupon->id,
                            'code' => $query->coupon->code,
                        ]
                        :
                        null,
                    'products'        => $query->orderProducts->map(function ($t) {
                        return [
                            'id'       => $t->product->translations->first()->id,
                            'name'     => $t->product->translations->first()->name,
                            'quantity' => $t->quantity,
                        ];
                    }),
                ])
                ->first();
    }
}
