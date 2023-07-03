<?php

use Illuminate\Support\Facades\Route;
use Modules\Package\Http\Controllers\PackageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin.')->middleware(['isAdmin'])->prefix("admin")->group(function () {
    Route::resource('packages', PackageController::class);
});