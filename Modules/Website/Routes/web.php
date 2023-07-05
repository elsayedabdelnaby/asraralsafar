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
use Modules\Website\Http\Controllers\Website\CruiseController;
use Modules\Website\Http\Controllers\Website\FlightController;
use Modules\Website\Http\Controllers\Website\AboutUsController;
use Modules\Website\Http\Controllers\Website\ContactController;
use Modules\Website\Http\Controllers\Website\PackageController;
use Modules\Website\Http\Controllers\Website\RequestController;
use Modules\Website\Http\Controllers\Website\IndexPageController;

sleep(2);
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    require __DIR__ . '/dashboard.php';
    Route::get('/', [IndexPageController::class, 'index'])->name('website.index');
    Route::get('/packages', [PackageController::class, 'index'])->name('package.index');
    Route::get('/packages/{id}', [PackageController::class, 'show'])->name('package.show');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('/blogs', [BlogController::class, 'index'])->name('website.blog.index');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('website.contact-us.store');
    Route::get('/faq', [FaqController::class, 'index']);
    Route::get('/flights', [FlightController::class, 'index'])->name('flight.index');
    Route::get('/cruises', [CruiseController::class, 'index'])->name('cruise.index');
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::get('/request/store', [RequestController::class, 'store'])->name('request.store');
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
