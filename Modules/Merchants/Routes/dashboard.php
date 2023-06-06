<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application.
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Merchants\Http\Controllers\Dashboard\BranchController;
use Modules\Merchants\Http\Controllers\Dashboard\CouponController;
use Modules\Merchants\Http\Controllers\Dashboard\DeliveryAdjustmentsController;
use Modules\Merchants\Http\Controllers\Dashboard\SocialController;
use Modules\Merchants\Http\Controllers\Dashboard\ProductController;
use Modules\Merchants\Http\Controllers\Dashboard\MerchantController;
use Modules\Merchants\Http\Controllers\Dashboard\DeliveryFeeController;
use Modules\Merchants\Http\Controllers\Dashboard\WorkingHourController;
use Modules\Merchants\Http\Controllers\Dashboard\ProductVariantController;
use Modules\Merchants\Http\Controllers\Dashboard\ProductAttributeController;
use Modules\Merchants\Http\Controllers\Dashboard\AdditionsProductsController;
use Modules\Merchants\Http\Controllers\Dashboard\BranchDeliveryFeeController;


Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {
    Route::name('merchants.')->group(function () {

        //Start Merchants Routes
        Route::prefix('merchants')->controller(MerchantController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-merchants')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-merchant')->name('create');
            Route::post('/store', 'store')->middleware('hasPermission:create-merchant')->name('store');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant')->name('toggle-status');
            Route::put('{id}/toggle-has-branches', 'toggleHasBranches')->middleware('hasPermission:update-merchant')->name('toggle-has-branches');
            Route::put('{id}/toggle-working-status', 'toggleWorkingStatus')->middleware('hasPermission:update-merchant')->name('toggle-working-status');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-merchant')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:update-merchant')->name('update');
            Route::delete('{id}', 'delete')->middleware('hasPermission:delete-merchant')->name('delete');
        });
        //End Merchants Routes

        //Start Social Routes
        Route::prefix('merchants')->name('social.')->controller(SocialController::class)->group(function () {
                Route::get('{merchant_id}/social', 'index')->middleware('hasPermission:listing-merchant-socials')->name('index');
            Route::get('{merchant_id}/social/create', 'create')->middleware('hasPermission:create-merchant-social')->name('create');
            Route::put('{merchant_id}/social/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-social')->name('toggle-status');
            Route::post('{merchant_id}/social', 'store')->middleware('hasPermission:create-merchant-social')->name('store');
            Route::get('{merchant_id}/social/{id}/edit', 'edit')->middleware('hasPermission:update-merchant-social')->name('edit');
            Route::put('{merchant_id}/social/{id}', 'update')->middleware('hasPermission:update-merchant-social')->name('update');
            Route::delete('{merchant_id}/social/{id}', 'delete')->middleware('hasPermission:delete-merchant-social')->name('delete');
        });
        //End Social Routes

        //Start Working Hours Routes
        Route::prefix('merchants')->name('working-hours.')->controller(WorkingHourController::class)->group(function () {
            Route::get('{merchant_id}/working-hours', 'index')->middleware('hasPermission:listing-merchant-working-hours')->name('index');
            Route::get('{merchant_id}/working-hours/create', 'create')->middleware('hasPermission:create-merchant-working-hours')->name('create');
            Route::put('{merchant_id}/working-hours/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-working-hours')->name('toggle-status');
            Route::post('{merchant_id}/working-hours', 'store')->middleware('hasPermission:create-merchant-working-hours')->name('store');
            Route::get('{merchant_id}/working-hours/{id}/edit', 'edit')->middleware('hasPermission:update-merchant-working-hours')->name('edit');
            Route::put('{merchant_id}/working-hours/{id}', 'update')->middleware('hasPermission:update-merchant-working-hours')->name('update');
            Route::delete('{merchant_id}/working-hours/{id}', 'delete')->middleware('hasPermission:delete-merchant-working-hours')->name('delete');
        });
        //End Working Hours Routes

        //Start Merchant Fees Routes
        Route::prefix('merchants')->name('merchant-fees.')->controller(DeliveryFeeController::class)->group(function () {
            Route::get('{merchant_id}/merchant-fees', 'index')->middleware('hasPermission:listing-merchant-delivery-fees')->name('index');
            Route::get('{merchant_id}/merchant-fees/create', 'create')->middleware('hasPermission:create-merchant-delivery-fees')->name('create');
            Route::post('{merchant_id}/merchant-fees', 'store')->middleware('hasPermission:create-merchant-delivery-fees')->name('store');
            Route::get('{merchant_id}/merchant-fees/{id}/edit', 'edit')->middleware('hasPermission:update-merchant-delivery-fees')->name('edit');
            Route::put('{merchant_id}/merchant-fees/{id}', 'update')->middleware('hasPermission:update-merchant-delivery-fees')->name('update');
            Route::delete('{merchant_id}/merchant-fees/{id}', 'delete')->middleware('hasPermission:delete-merchant-delivery-fees')->name('delete');
        });
        //End Merchant Fees Routes


        //Start Merchant Branches Routes
        Route::prefix('merchants')->name('branches.')->controller(BranchController::class)->group(function () {
            Route::get('{merchant_id}/branches', 'index')->middleware('hasPermission:listing-merchant-branches')->name('index');
            Route::get('{merchant_id}/branches/create', 'create')->middleware('hasPermission:create-merchant-branches')->name('create');
            Route::post('{merchant_id}/branches', 'store')->middleware('hasPermission:create-merchant-branches')->name('store');
            Route::put('{merchant_id}/branches/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-branches')->name('toggle-status');
            Route::get('{merchant_id}/branches/{id}/edit', 'edit')->middleware('hasPermission:update-merchant-branches')->name('edit');
            Route::put('{merchant_id}/branches/{id}', 'update')->middleware('hasPermission:update-merchant-branches')->name('update');
            Route::delete('{merchant_id}/branches/{id}', 'delete')->middleware('hasPermission:delete-merchant-branches')->name('delete');
        });
        //End Merchant Branches Routes

        //Start Merchant Fees Routes
        Route::prefix('merchants')->name('branch-fees.')->controller(BranchDeliveryFeeController::class)->group(function () {
            Route::get('{merchant_id}/branches/{branch_id}/branch-fees', 'index')->middleware('hasPermission:listing-merchant-delivery-fees')->name('index');
            Route::get('{merchant_id}/branches/{branch_id}/branch-fees/create', 'create')->middleware('hasPermission:create-merchant-delivery-fees')->name('create');
            Route::post('{merchant_id}/branches/{branch_id}/branch-fees', 'store')->middleware('hasPermission:create-merchant-delivery-fees')->name('store');
            Route::get('{merchant_id}/branches/{branch_id}/branch-fees/{id}/edit', 'edit')->middleware('hasPermission:update-merchant-delivery-fees')->name('edit');
            Route::put('{merchant_id}/branches/{branch_id}/branch-fees/{id}', 'update')->middleware('hasPermission:update-merchant-delivery-fees')->name('update');
            Route::delete('{merchant_id}/branches/{branch_id}/branch-fees/{id}', 'delete')->middleware('hasPermission:delete-merchant-delivery-fees')->name('delete');
        });
        //End Merchant Fees Routes

        //Start Merchant Coupons Routes
        Route::prefix('merchants')->name('coupons.')->controller(CouponController::class)->group(function () {
            Route::get('{merchant_id}/coupons', 'index')->middleware('hasPermission:listing-merchant-coupons')->name('index');
            Route::get('{merchant_id}/coupons/create', 'create')->middleware('hasPermission:create-merchant-coupon')->name('create');
            Route::post('{merchant_id}/coupons', 'store')->middleware('hasPermission:create-merchant-branches')->name('store');
            Route::get('{merchant_id}/coupons/edit/{id}', 'edit')->middleware('hasPermission:update-merchant-coupon')->name('edit');
            Route::put('{merchant_id}/coupons/{id}', 'update')->middleware('hasPermission:update-merchant-coupon')->name('update');
            Route::put('{merchant_id}/coupons/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-coupon')->name('toggle-status');
            Route::delete('{merchant_id}/coupons/{id}/', 'delete')->middleware('hasPermission:delete-merchant-coupon')->name('delete');

            Route::get('coupons', 'index')->middleware('hasPermission:listing-merchant-coupons')->name('index-global');
            Route::get('coupons/create', 'create')->middleware('hasPermission:create-merchant-coupon')->name('create-global');
            Route::post('coupons', 'store')->middleware('hasPermission:create-merchant-branches')->name('store-global');
            Route::get('coupons/edit/{id}', 'edit')->middleware('hasPermission:update-merchant-coupon')->name('edit-global');
            Route::put('coupons/{id}', 'update')->middleware('hasPermission:update-merchant-coupon')->name('update-global');
            Route::put('coupons/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-coupon')->name('toggle-status-global');
            Route::delete('coupons/{id}/', 'delete')->middleware('hasPermission:delete-merchant-coupon')->name('delete-global');
        });
        //End Merchant Coupons Routes

        //Start Additions Products Routes
        Route::prefix('merchants')->name('additions-products.')->controller(AdditionsProductsController::class)->group(function () {
            Route::get('{merchant_id}/additions-products', 'index')->middleware('hasPermission:listing-merchant-additions-products')->name('index');
            Route::get('{merchant_id}/additions-products/create', 'create')->middleware('hasPermission:create-merchant-additions-product')->name('create');
            Route::put('{merchant_id}/additions-products/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-additions-product')->name('toggle-status');
            Route::post('{merchant_id}/additions-products', 'store')->middleware('hasPermission:create-merchant-additions-product')->name('store');
            Route::get('{merchant_id}/additions-products/{id}/edit', 'edit')->middleware('hasPermission:update-merchant-additions-product')->name('edit');
            Route::put('{merchant_id}/additions-products/{id}', 'update')->middleware('hasPermission:update-merchant-additions-product')->name('update');
            Route::delete('{merchant_id}/additions-products/{id}', 'delete')->middleware('hasPermission:delete-merchant-additions-product')->name('delete');
        });
        //End Additions Products Routes

        //Start Merchants Product Routes
        Route::prefix('merchants')->name('products.')->controller(ProductController::class)->group(function () {
            Route::get('{merchant_id}/products', 'index')->middleware('hasPermission:listing-products')->name('index');
            Route::get('{merchant_id}/products/create', 'create')->middleware('hasPermission:create-product')->name('create');
            Route::post('{merchant_id}/products/store', 'store')->middleware('hasPermission:create-product')->name('store');
            Route::put('{merchant_id}/products/{id}/toggle', 'toggle')->middleware('hasPermission:update-product')->name('toggle-status');
            Route::put('{merchant_id}/products/{id}/acceptAdditions', 'acceptAdditions')->middleware('hasPermission:update-product')->name('toggle-accept-additions');
            Route::get('{merchant_id}/products/{id}/edit', 'edit')->middleware('hasPermission:update-product')->name('edit');
            Route::get('{merchant_id}/products/{category_type_id}', 'getCategories')->middleware('hasPermission:listing-products')->name('getCategories');
            Route::put('{merchant_id}/products/{id}/update', 'update')->middleware('hasPermission:update-product')->name('update');
            Route::delete('{merchant_id}/products/{id}', 'delete')->middleware('hasPermission:delete-product')->name('delete');
            Route::get('{merchant_id}/getMerchantProducts', 'getMerchantProducts')->middleware('hasPermission:listing-products')->name('getMerchantProducts');
            Route::get('{merchant_id}/export-variant', 'exportVariant')->middleware('hasPermission:export-products')->name('export-variant');
            Route::get('{merchant_id}/export-simple', 'exportSimple')->middleware('hasPermission:export-products')->name('export-simple');
            Route::post('{merchant_id}/import-price', 'importPrice')->middleware('hasPermission:import-price')->name('import-price');
            Route::post('{merchant_id}/import-product', 'importProduct')->middleware('hasPermission:import-product')->name('import-product');
        });
        //End Merchants Product Routes

        //Start Merchants Product Variant Routes
        Route::prefix('merchants')->name('products-variant.')->controller(ProductVariantController::class)->group(function () {
            Route::get('{merchant_id}/products/{product_id}/product-variant/', 'index')->middleware('hasPermission:listing-product-variants')->name('index');
            Route::get('{merchant_id}/products/{product_id}/product-variant/create', 'create')->middleware('hasPermission:create-product-variant')->name('create');
            Route::post('{merchant_id}/products/{product_id}/product-variant/store', 'store')->middleware('hasPermission:create-product-variant')->name('store');
            Route::put('{merchant_id}/products/{product_id}/product-variant/{id}/toggle', 'toggle')->middleware('hasPermission:update-product-variant')->name('toggle-status');
            Route::get('{merchant_id}/products/{product_id}/product-variant/{id}/edit', 'edit')->middleware('hasPermission:update-product-variant')->name('edit');
            Route::put('{merchant_id}/products/{product_id}/product-variant/{id}/update', 'update')->middleware('hasPermission:update-product-variant')->name('update');
            Route::delete('{merchant_id}/products/{product_id}/product-variant/{id}/delete', 'delete')->middleware('hasPermission:delete-product-variant')->name('delete');
            Route::get('{merchant_id}/products/{product_id}/product-variant/{id}/get-attribute-options', 'getAttributeOptions')->middleware('hasPermission:listing-product-variants')->name('getAttributeOptions');
        });
        //End Merchants Product Variant Routes

        //Start Delivery Adjustments
        Route::prefix('merchants')->name('delivery-adjustments.')->controller(DeliveryAdjustmentsController::class)->group(function () {
            Route::get('delivery-adjustments', 'index')->middleware('hasPermission:listing-merchant-delivery-adjustments')->name('index');
            Route::get('delivery-adjustments/create', 'create')->middleware('hasPermission:create-merchant-delivery-adjustment')->name('create');
            Route::post('delivery-adjustments', 'store')->middleware('hasPermission:create-merchant-delivery-adjustment')->name('store');
            Route::get('delivery-adjustments/edit/{id}', 'edit')->middleware('hasPermission:update-merchant-delivery-adjustment')->name('edit');
            Route::put('delivery-adjustments/{id}', 'update')->middleware('hasPermission:update-merchant-delivery-adjustment')->name('update');
            Route::put('delivery-adjustments/{id}/toggle', 'toggle')->middleware('hasPermission:update-merchant-delivery-adjustment')->name('toggle-status');
            Route::put('delivery-adjustments/{id}/toggle-apply-on-cash', 'toggleApplyOnCash')->middleware('hasPermission:update-merchant-delivery-adjustment')->name('toggle-apply-on-cash');
            Route::put('delivery-adjustments/{id}/toggle-apply-on-wallet', 'toggleApplyOnWallet')->middleware('hasPermission:update-merchant-delivery-adjustment')->name('toggle-apply-on-wallet');
            Route::delete('delivery-adjustments/{id}/', 'delete')->middleware('hasPermission:delete-merchant-delivery-adjustment')->name('delete');
        });
        //End Delivery Adjustments

    });

    Route::prefix('products')->name('products.')->group(function () {
        //Start product attributes routes
        Route::prefix('product-attributes')->name('product-attributes.')->controller(ProductAttributeController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-product-attributes')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-product-attribute')->name('create');
            Route::post('/store', 'store')->middleware('hasPermission:create-product-attribute')->name('store');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-product-attribute')->name('toggle-status');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-product-attribute')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:update-product-attribute')->name('update');
            Route::delete('{id}', 'delete')->middleware('hasPermission:delete-product-attribute')->name('delete');
        });
        //End product attributes routes
    });
});
