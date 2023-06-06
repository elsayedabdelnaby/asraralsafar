<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashbaord routes for your application.
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Sales\Http\Controllers\Dashboard\OrderController;
use Modules\Sales\Http\Controllers\Dashboard\OrderStatusController;
use Modules\Sales\Http\Controllers\SalesController;
use Modules\Sales\Http\Controllers\Dashboard\CustomerController;
use Modules\Sales\Http\Controllers\Dashboard\CustomerAddressController;

Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {
    Route::name('sales.')->prefix('sales')->group(function () {

        Route::get('/', [SalesController::class, 'index'])->middleware('hasPermission:access-sales');

        //customers routes
        Route::prefix('customers')->name('customers.')->controller(CustomerController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-customers')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-customer')->name('create');
            Route::post('/store', 'store')->middleware('hasPermission:create-customer')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-customer')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:update-customer')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-customer')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-customer')->name('toggle-status');
        });
        //End customers routes

        //Customer addresses routes
        Route::name('customer-addresses.')->controller(CustomerAddressController::class)->group(function () {
            Route::get('customers/{customer_id}/addresses', 'index')->middleware('hasPermission:listing-customer-addresses')->name('index');
            Route::get('customers/{customer_id}/addresses/create', 'create')->middleware('hasPermission:create-customer-address')->name('create');
            Route::post('customers/{customer_id}/addresses/store', 'store')->middleware('hasPermission:create-customer-address')->name('store');
            Route::get('customers/{customer_id}/addresses/{id}/edit', 'edit')->middleware('hasPermission:update-customer-address')->name('edit');
            Route::put('customers/{customer_id}/addresses/{id}/update', 'update')->middleware('hasPermission:update-customer-address')->name('update');
            Route::delete('customers/{customer_id}/addresses/{id}/delete', 'delete')->middleware('hasPermission:delete-customer-address')->name('destroy');
            Route::put('customers/{customer_id}/addresses/{id}/toggle', 'toggle')->middleware('hasPermission:update-customer-address')->name('toggle-status');
        });
        //End customer addresses

        //Start Order Routes
        Route::prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-orders')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-order')->name('create');
            Route::post('/', 'store')->middleware('hasPermission:create-order')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-order')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-order')->name('update');
            Route::delete('{id}', 'delete')->middleware('hasPermission:delete-order')->name('delete');
            Route::get('/customer-address/{customer_id}', 'queryCustomerAddressByCustomerId')->middleware('hasPermission:listing-orders')->name('customer-address');
            Route::get('/merchant-branch/{merchant_id}', 'queryMerchantBranchByMerchantId')->middleware('hasPermission:listing-orders')->name('merchant-branch');
            Route::get('/address-delivery/{address_id}', 'queryDeliveryGuysBYCustomerAddressId')->middleware('hasPermission:listing-orders')->name('address-delivery');
        });
        //End Order Routes

        //Start Order Status
        Route::prefix('order-status')->name('order-status.')->controller(OrderStatusController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-orders-status')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-order-status')->name('create');
            Route::post('/', 'store')->middleware('hasPermission:create-order-status')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-order-status')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-order-status')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-order-status')->name('toggle-status');
            Route::delete('{id}', 'delete')->middleware('hasPermission:delete-order-status')->name('delete');
            Route::post('/indexing/update-reorder','updateReorder')->middleware(['hasPermission:update-order-status'])->name('update-reorder');
        });
        //End Order Status


    });
});
