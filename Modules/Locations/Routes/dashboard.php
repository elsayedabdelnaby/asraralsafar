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
use Modules\Locations\Http\Controllers\Dashboard\CityController;
use Modules\Locations\Http\Controllers\Dashboard\StateController;
use Modules\Locations\Http\Controllers\Dashboard\CountryController;


Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {
    Route::name('locations.')->prefix('locations')->group(function () {

        //Start Countries Routes
        Route::prefix('countries')->name('countries.')->controller(CountryController::class)->group(function () {
            Route::get('/', 'index')->middleware('hasPermission:listing-countries')->name('index');
            Route::get('/create', 'create')->middleware('hasPermission:create-country')->name('create');
            Route::post('/store', 'store')->middleware('hasPermission:create-country')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-country')->name('edit');
            Route::put('{id}/update', 'update')->middleware('hasPermission:update-country')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-country')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-country')->name('toggle-status');
        });
        //End Countries Routes

        //Start States Routes
        Route::name('states.')->controller(StateController::class)->group(function () {
            Route::get('countries/{country_id}/states', 'index')->middleware('hasPermission:listing-states')->name('index');
            Route::get('countries/{country_id}/states/create', 'create')->middleware('hasPermission:create-state')->name('create');
            Route::post('countries/{country_id}/states/store', 'store')->middleware('hasPermission:create-state')->name('store');
            Route::get('countries/{country_id}/states/{id}/edit', 'edit')->middleware('hasPermission:update-state')->name('edit');
            Route::put('countries/{country_id}/states/{id}/update', 'update')->middleware('hasPermission:update-state')->name('update');
            Route::delete('states/{id}/', 'destroy')->middleware('hasPermission:delete-state')->name('destroy');
            Route::put('states/{id}/toggle', 'toggle')->middleware('hasPermission:update-state')->name('toggle-status');
        });
        //End States Routes

        //Start Cities Routes
        Route::name('cities.')->controller(CityController::class)->group(function () {
            Route::get('countries/{country_id}/states/{state_id}/cities', 'index')->middleware('hasPermission:listing-cities')->name('index');
            Route::get('countries/{country_id}/states/{state_id}/cities/create', 'create')->middleware('hasPermission:create-city')->name('create');
            Route::post('countries/{country_id}/states/{state_id}/cities/store', 'store')->middleware('hasPermission:create-city')->name('store');
            Route::get('countries/{country_id}/states/{state_id}/cities/{id}/edit', 'edit')->middleware('hasPermission:update-city')->name('edit');
            Route::put('countries/{country_id}/states/{state_id}/cities/{id}/update', 'update')->middleware('hasPermission:update-city')->name('update');
            Route::delete('cities/{id}', 'destroy')->middleware('hasPermission:delete-city')->name('destroy');
            Route::put('cities/{id}/toggle', 'toggle')->middleware('hasPermission:update-city')->name('toggle-status');
        });
        //End Cities Routes
    });
});
