<?php

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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Modules\Website\Http\Controllers\Website\FaqController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Website\Http\Controllers\Website\BlogController;
use Modules\Website\Http\Controllers\Website\FlightController;
use Modules\Website\Http\Controllers\Website\AboutUsController;
use Modules\Website\Http\Controllers\Website\ContactController;
use Modules\Website\Http\Controllers\Website\PackageController;
use Modules\Website\Http\Controllers\Website\IndexPageController;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    require __DIR__ . '/dashboard.php';
    Route::get('/', [IndexPageController::class, 'index'])->name('soso');
    Route::get('/package', [PackageController::class, 'index']);
    Route::get('/about-us', [AboutUsController::class, 'index']);
    Route::get('/blogs', [BlogController::class, 'index'])->name('website.blog.index');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/contact-us', [ContactController::class, 'index']);
    Route::post('/contact-us', [ContactController::class, 'store'])->name('website.contact-us.store');
    Route::get('/faq', [FaqController::class, 'index']);
    Route::get('/flight', [FlightController::class, 'index']);
    Route::get('set-locale', function () {
        $url = url()->previous();

        if (app()->getlocale() == 'en') {
            $newUrl  = str_replace('/en', '/ar', $url);
        } else {
            $newUrl  = str_replace('/ar', '/en', $url);
        }

        return redirect($newUrl);
    })->name('set-locale');
});
