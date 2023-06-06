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
use Modules\UsersManagement\Http\Controllers\Dashboard\RoleController;
use Modules\UsersManagement\Http\Controllers\Dashboard\UserController;
use Modules\UsersManagement\Http\Controllers\Dashboard\AvatarController;
use Modules\UsersManagement\Http\Controllers\Dashboard\ProfileController;
use Modules\UsersManagement\Http\Controllers\Dashboard\UsersManagementController;

Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {
    Route::name('users-management.')->prefix('usersmanagement')->group(function () {
        Route::get('/', [UsersManagementController::class, 'index'])->middleware('hasPermission:access-users-management');

        Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-users')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-user')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-user')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-user')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-user')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-user')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-user')->name('toggle-status');
            Route::get('{id}/edit-password', 'editPassword')->middleware('hasPermission:update-user')->name('edit-password');
            Route::post('{id}/update-password', 'updatePassword')->middleware('hasPermission:update-user')->name('update-password');
            Route::get('{id}/delete', 'delete')->middleware('hasPermission:delete-user')->name('delete');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-user')->name('destroy');
        });

        Route::prefix('profiles')->name('profiles.')->controller(ProfileController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-profiles')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-profile')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-profile')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-profile')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-profile')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-profile')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-profile')->name('destroy');
            Route::get('{id}/delete', 'delete')->middleware('hasPermission:delete-profile')->name('delete');
        });

        Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-roles')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-role')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-role')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-role')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-role')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-role')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-role')->name('destroy');
        });

        Route::prefix('avatars')->name('avatars.')->controller(AvatarController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-avatars')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-avatar')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-avatar')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-avatar')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-avatar')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-avatar')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-avatar')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-avatar')->name('toggle-status');
        });
    });
});
