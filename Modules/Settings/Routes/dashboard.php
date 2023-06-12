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
use Modules\Settings\Http\Controllers\Dashboard\DeliveryFeeController;
use Modules\Settings\Http\Controllers\Dashboard\TagController;
use Modules\Settings\Http\Controllers\Dashboard\CategoryController;
use Modules\Settings\Http\Controllers\Dashboard\CurrencyController;
use Modules\Settings\Http\Controllers\Dashboard\SubCategoryController;
use Modules\Settings\Http\Controllers\Dashboard\CategoryTypeController;

Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {
    Route::name('settings.')->prefix('settings')->group(function () {

        // routes of category types
        Route::prefix('category-types')->name('category-types.')->controller(CategoryTypeController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-category-types')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-category-type')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-category-type')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-category-type')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-category-type')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-category-type')->name('update');
            Route::get('{id}/delete', 'delete')->middleware('hasPermission:delete-category-type')->name('delete');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-category-type')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-category-type')->name('toggle-status');
        });

        // routes of main categories
        Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-categories')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-category')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-category')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-category')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-category')->name('update');
            Route::get('{id}/delete', 'delete')->middleware('hasPermission:delete-category')->name('delete');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-category')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-category')->name('toggle-status');
            Route::get('export', 'export')->middleware('hasPermission:exporting-merchant-categories')->name('export');
        });

        // routes of the categories
        Route::prefix('categories')->name('subcategories.')->controller(SubCategoryController::class)->group(function () {
            Route::get('{category_id}/subcategories', 'index')->middleware('hasPermission:listing-categories')->name('index');
            Route::get('{category_id}/subcategories/create', 'create')->middleware('hasPermission:create-category')->name('create');
            Route::post('{category_id}/subcategories', 'store')->middleware('hasPermission:create-category')->name('store');
            Route::get('{category_id}/subcategories/{id}/edit', 'edit')->middleware('hasPermission:update-category')->name('edit');
            Route::put('{category_id}/subcategories/{id}', 'update')->middleware('hasPermission:update-category')->name('update');
        });

        // routes of tags
        Route::prefix('tags')->name('tags.')->controller(TagController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-tags')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-tag')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-tag')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-tag')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-tag')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-tag')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-tag')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-tag')->name('toggle-status');
        });

        // routes of currencies
        Route::prefix('currencies')->name('currencies.')->controller(CurrencyController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-currencies')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-currency')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-currency')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-currency')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-currency')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-currency')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-currency')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-currency')->name('toggle-status');
        });
    });
});
