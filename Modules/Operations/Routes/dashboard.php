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
use Modules\Operations\Http\Controllers\Dashboard\BookingRequestController;

Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {

    Route::prefix('operations')->name('operations.')->group(function () {

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

        //Start Booking Requests
        Route::prefix('booking-requests')->name('booking-requests.')->controller(BookingRequestController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-booking-requests')->name('index');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:edit-booking-requests')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:edit-booking-requests')->name('update');
        });
        //End Booking Requests


    });
});
