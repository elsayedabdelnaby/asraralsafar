<?php

use App\Http\Controllers\Dashboard\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::prefix("dashboard")->group(function () {
    Route::middleware('guest')->controller(LoginController::class)->group(function () {
        Route::get('login', 'showDashboardLoginForm');
        Route::post('login', 'dashboardLogin');
    });

    Route::name('dashboard.')->middleware(['isAdmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        // routes of languages
        Route::prefix('languages')->name('languages.')->controller(LanguageController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-languages')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-language')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-language')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-language')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-language')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-language')->name('toggle-status');
            Route::delete('{id}/delete', 'delete')->middleware('hasPermission:delete-language')->name('delete');

        });
    });


});
