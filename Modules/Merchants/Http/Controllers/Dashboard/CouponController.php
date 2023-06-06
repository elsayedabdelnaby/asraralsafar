<?php

namespace Modules\Merchants\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Locations\Actions\City\FilterCitiesAction;
use Modules\Merchants\Actions\Coupon\DeleteMerchantCouponAction;
use Modules\Merchants\Actions\Coupon\FilterMerchantCouponAction;
use Modules\Merchants\Actions\Coupon\StoreMerchantCouponAction;
use Modules\Merchants\Actions\Coupon\ToggleMerchantCouponAction;
use Modules\Merchants\Actions\Coupon\UpdateMerchantCouponAction;
use Modules\Merchants\Actions\Merchant\FilterMerchantsAction;
use Modules\Merchants\Actions\MerchantBranch\FilterMerchantBranchActions;
use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Enums\CouponStatus;
use Modules\Merchants\Enums\CouponType;
use Modules\Merchants\Enums\CouponValueType;
use Modules\Merchants\Http\Requests\Coupon\CreateMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\DeleteMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\EditMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\IndexMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\StoreMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\ToggleMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\UpdateMerchantCouponRequest;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;


class CouponController extends Controller
{
    /**
     * @param IndexMerchantCouponRequest $request
     * @param FilterMerchantCouponAction $action
     * @return array|Application|Factory|View
     */
    public function index(IndexMerchantCouponRequest $request, FilterMerchantCouponAction $action): View|Factory|array|Application
    {
        if ($request->ajax()) {
            $coupons = self::queryCouponData($request, $action);
            $total = count($coupons);

            return [
                'data' => $coupons,
                'recordTotal' => $total,
                'recordsFiltered' => $total
            ];
        }
        $merchant = Merchant::find($request->get('merchant_id'));

        return view('merchants::coupons.indexing.index')
            ->with(['merchant' => $merchant]);

    }

    /**
     * Show the form for creating a new resource.
     * @param CreateMerchantCouponRequest $request
     * @return View
     */
    public function create(CreateMerchantCouponRequest $request): View
    {
        return view('merchants::coupons.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => isset($request->merchant_id) ?
                    route('dashboard.merchants.coupons.store', ['merchant_id' => $request->merchant_id])
                    :
                    route('dashboard.merchants.coupons.store-global'),
                'merchant' => Merchant::find($request->merchant_id),
                'type' => CouponType::cases(),
                'value_type' => CouponValueType::cases(),
                'status' => CouponStatus::cases(),
                'branches' => (new FilterMerchantBranchActions())->handle($request)->get(),
//                'products' => (new (FilterMer))->handle($request)->get(), to
                'merchants' => self::queryApplyingData($request)['merchants'],
                'categories' => self::queryApplyingData($request)['categories'],
                'cities' => self::queryApplyingData($request)['cities'],
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMerchantCouponRequest $request
     * @param StoreMerchantCouponAction $action
     * @return Renderable|RedirectResponse
     */
    public function store(StoreMerchantCouponRequest $request, StoreMerchantCouponAction $action): Renderable|RedirectResponse
    {
        $merchant_id = $request->get('merchant_id');
        try {
            $action->handle($request);
            return redirect(isset($merchant_id) ?
                route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant_id])
                :
                route('dashboard.merchants.coupons.index-global'))
                ->with(
                    'success',
                    __('dashboard.created_successfully')
                );
        } catch (Exception $e) {
            return redirect(isset($merchant_id) ?
                route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant_id])
                :
                route('dashboard.merchants.coupons.index-global'))
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditMerchantCouponRequest $request
     * @return Renderable
     */
    public function edit(EditMerchantCouponRequest $request)
    {
        return view('merchants::coupons.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => isset($request->merchant_id) ?
                    route('dashboard.merchants.coupons.update', ['merchant_id' => $request->merchant_id, 'id' => $request->id])
                    :
                    route('dashboard.merchants.coupons.update-global', ['id' => $request->id]),
                'coupon' => self::queryCouponDataByCouponId($request->id),
                'merchant' => Merchant::find($request->merchant_id),
                'type' => CouponType::cases(),
                'status' => CouponStatus::cases(),
                'branches' => (new FilterMerchantBranchActions())->handle($request)->get(),
//                'products' => (new (FilterMer))->handle($request)->get(), to
                'merchants' => self::queryApplyingData($request)['merchants'],
                'categories' => self::queryApplyingData($request)['categories'],
                'cities' => self::queryApplyingData($request)['cities'],
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMerchantCouponRequest $request
     * @param UpdateMerchantCouponAction $action
     * @return Renderable
     */
    public function update(UpdateMerchantCouponRequest $request, UpdateMerchantCouponAction $action)
    {
        $merchant_id = $request->get('merchant_id');
        try {
            $action->handle($request);
            return redirect(isset($merchant_id) ?
                route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant_id])
                :
                route('dashboard.merchants.coupons.index-global'))
                ->with(
                    'success',
                    __('dashboard.updated_successfully')
                );
        } catch (Exception $e) {
            return redirect(isset($merchant_id) ?
                route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant_id])
                :
                route('dashboard.merchants.coupons.index-global'))
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    /**
     * Toggle the specified category.
     * @param ToggleMerchantCouponRequest $toggle_request
     * @param ToggleMerchantCouponAction $action
     * @return JsonResponse
     */
    public function toggle(ToggleMerchantCouponRequest $toggle_request, ToggleMerchantCouponAction $action): JsonResponse
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('merchants::dashboard.the_coupon_toggle_was_successfully'),
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
     * Remove the specified resource from storage.
     * @param DeleteMerchantCouponRequest $request
     * @param DeleteMerchantCouponAction $action
     * @return Renderable
     */
    public function delete(DeleteMerchantCouponRequest $request, DeleteMerchantCouponAction $action)
    {
        try {
            $action->handle($request);
            return response()->json([
                'status' => 'success',
                'message' => __('merchants::dashboard.the_merchant_coupon_is_deleted'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param CreateMerchantCouponRequest|EditMerchantCouponRequest $request
     * @return array
     */
    static protected function queryApplyingData(CreateMerchantCouponRequest|EditMerchantCouponRequest $request): array
    {
        $request->request->add(['category_id' => 1]); // To get product categories

        $applying = [];

        $applying['categories'] = (new FilterCategoriesAction())->handle($request)->get()
            ->map(function ($q) {
                return (object)[
                    'id' => $q->category_id,
                    'name' => $q->slug
                ];
            });


        $applying['merchants'] = (new FilterMerchantsAction())->handle($request)->get()
            ->map(function ($q) {
                return (object)[
                    'id' => $q->merchant_id,
                    'name' => $q->name
                ];
            });

        $applying['cities'] = (new FilterCitiesAction())->handle($request)->get()
            ->map(function ($q) {
                return (object)[
                    'id' => $q->city_id,
                    'name' => $q->name
                ];
            });

        return $applying;
    }

    /**
     * @param IndexMerchantCouponRequest $request
     * @param FilterMerchantCouponAction $action
     * @return void
     */
    static protected function queryCouponData(IndexMerchantCouponRequest $request, FilterMerchantCouponAction $action): Collection
    {
        $coupon_cols = self::queryCouponParameters();

        if (is_null($request->get('merchant_id'))) {
            $coupons = $action->handle($request)->select($coupon_cols)
                ->whereNull('merchant_id');
        } else {
            $coupon_cols[] = DB::raw('IFNULL(merchant_translations.name, 0) as merchant_name');
            $coupons = $action->handle($request)->select($coupon_cols)
                ->join('merchant_translations', 'coupons.merchant_id', '=', 'merchant_translations.merchant_id')
                ->where('merchant_translations.language_id', getCurrentLanguage()->id);
        }

        return $coupons->get();
    }

    /**
     * @param int $coupon_id
     * @return array
     */
    static protected function queryCouponDataByCouponId(int $coupon_id): array
    {
        return
            Coupon::with('translations')
                ->with(['categories.translations' => function ($q) {
                    $q->where('category_translations.language_id', getCurrentLanguage()->id);
                }])->with(['merchant.translations' => function ($q) {
                    $q->where('merchant_translations.language_id', getCurrentLanguage()->id);
                }])->with(['cities.translations' => function ($q) {
                    $q->where('city_translations.language_id', getCurrentLanguage()->id);
                }])->with(['branches.translations' => function ($q) {
                    $q->where('merchant_branches_translations.language_id', getCurrentLanguage()->id);
                }])->with(['products.translations' => function ($q) {
                    $q->where('product_translations.language_id', getCurrentLanguage()->id);
                }])
                ->where('coupons.id', $coupon_id)
                ->get()
                ->map(callback: fn($query) => [
                    'id' => $query->id,
                    'code' => $query->code,
                    'value_type' => $query->type,
                    'value' => $query->type,
                    'start_date' => $query->start_date,
                    'end_date' => $query->end_date,
                    'one_time' => $query->one_time,
                    'first_order' => $query->first_order,
                    'apply_on_cash' => $query->apply_on_cash,
                    'apply_on_card' => $query->apply_on_card,
                    'status' => $query->status,
                    'is_active' => $query->is_active,
                    'limited_usage' => $query->limited_usage ?? 0,
                    'user_max_usage' => $query->user_max_usage ?? 0,
                    'min_order' => $query->min_order ?? 0,
                    'max_order' => $query->max_order ?? 0,
                    'min_shipping' => $query->min_shipping ?? 0,
                    'max_shipping' => $query->max_shipping ?? 0,
                    'translations' => $query->translations->map(function ($t) {
                        return [
                            'id' => $t->coupon_id,
                            'name' => $t->name,
                            'language_id' => $t->language_id,
                        ];
                    }),
                    'categories' => $query->categories->map(function ($t) {
                        return $t->translations->first()->category_id;
                    }),
                    'branches' => $query->branches->map(function ($t) {
                        return $t->translations->first()->merchant_branch_id;
                    }),
                    'cities' => $query->cities->map(function ($t) {
                        return $t->translations->first()->city_id;
                    }),
                    'merchant' => isset($query->merchant)
                        ?
                        $query->merchant->translations->map(function ($t) {
                            return [
                                'id' => $t->merchant_id,
                                'name' => $t->name,
                            ];
                        })
                        :
                        null,
                ])
                ->first();
    }

    static private function queryCouponParameters(): array
    {
        return [
            'coupons.id',
            'coupon_translations.name as name',
            'coupons.code',
            'coupons.type',
            'coupons.value_type',
            'coupons.value',
            'coupons.start_date',
            'coupons.end_date',
            'coupons.one_time',
            'coupons.first_order',
            'coupons.apply_on_cash',
            'coupons.apply_on_card',
            'coupons.status',
            'coupons.is_active',
            'coupon_translations.name as name',
            'coupons.start_date',
            'coupons.end_date',
            'coupons.one_time',
            DB::raw('IFNULL(coupons.limited_usage, 0) as limited_usage'),
            DB::raw('IFNULL(coupons.user_max_usage, 0) as user_max_usage'),
            DB::raw('IFNULL(coupons.min_order, 0) as min_order'),
            DB::raw('IFNULL(coupons.max_order, 0) as max_order'),
            DB::raw('IFNULL(coupons.min_shipping, 0) as min_shipping'),
            DB::raw('IFNULL(coupons.max_shipping, 0) as max_shipping'),
            DB::raw('NULL as merchant_name'),
            DB::raw('NULL as actions'),
        ];
    }

}
