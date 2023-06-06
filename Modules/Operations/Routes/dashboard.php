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
use Modules\Operations\Http\Controllers\Dashboard\ContactUsController;
use Modules\Operations\Http\Controllers\Dashboard\ActivityLogController;
use Modules\Operations\Http\Controllers\Dashboard\DeliveryGuyController;
use Modules\Operations\Http\Controllers\Dashboard\OrdersMonitoringController;

Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {

    Route::prefix('operations')->name('operations.')->group(function () {

        //Start Of Delivery Guy
        Route::prefix('delivery-guys')->name('delivery-guys.')->controller(DeliveryGuyController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-delivery-guys')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-delivery-guys')->name('create');
            Route::post('/store', 'store')->middleware('hasPermission:create-delivery-guys')->name('store');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-delivery-guys')->name('toggle-status');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-delivery-guys')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:update-delivery-guys')->name('update');
            Route::delete('{id}', 'delete')->middleware('hasPermission:delete-delivery-guys')->name('delete');
        });
        //End Of Delivery Guy

        //Start Of Activity Log
        Route::prefix('activity-logs')->name('activity-logs.')->controller(ActivityLogController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-activity-logs')->name('index');
        });
        //End Of Activity Log

        //Start Of Contact Us Messages
        Route::prefix('contact-us')->name('contact-us.')->controller(ContactUsController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-contact-us-messages')->name('index');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:reply-on-contact-us-message')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:reply-on-contact-us-message')->name('update');
        });
        //End Of Contact Us Messages


        //Start Orders Monitoring
        Route::prefix('orders-monitoring')->name('orders-monitoring.')->controller(OrdersMonitoringController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-orders')->name('index');
            Route::get('/{id}/delivery_location', 'getDeliveryLocation')->middleware('hasPermission:listing-orders')->name('getDeliveryLocation');
            Route::get('/{id}/order_details', 'getOrderDetails')->middleware('hasPermission:listing-orders')->name('getOrderDetails');
            Route::post('/update-order-status', 'updateOrderStatus')->middleware('hasPermission:update-order-status')->name('updateOrderStatus');
            Route::get('{id}/getDeliveryGuys', 'getDeliveryGuys')->middleware('hasPermission:listing-delivery-guys')->name('getDeliveryGuys');
            Route::post('assignDelivery', 'assignDelivery')->middleware('hasPermission:listing-delivery-guys')->name('assignDelivery');
        });
        //End Orders Monitoring


    });
});
