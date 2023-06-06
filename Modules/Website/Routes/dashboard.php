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
use Modules\Website\Http\Controllers\WebsiteController;
use Modules\Website\Http\Controllers\Dashboard\FAQController;
use Modules\Website\Http\Controllers\Dashboard\BlogController;
use Modules\Website\Http\Controllers\Dashboard\MetaPageController;
use Modules\Website\Http\Controllers\Dashboard\FooterLinkController;
use Modules\Website\Http\Controllers\Dashboard\MainSliderController;
use Modules\Website\Http\Controllers\Dashboard\SocialLinkController;
use Modules\Website\Http\Controllers\Dashboard\InformationController;
use Modules\Website\Http\Controllers\Dashboard\FooterSectionController;
use Modules\Website\Http\Controllers\Dashboard\PrivacyPolicyController;
use Modules\Website\Http\Controllers\Dashboard\TermConditionController;
use Modules\Website\Http\Controllers\Dashboard\ContactInformationController;

Route::name('dashboard.')->middleware(['isAdmin'])->prefix("dashboard")->group(function () {
    Route::name('website.')->prefix('website')->group(function () {

        Route::get('/', [WebsiteController::class, 'index'])->middleware('hasPermission:access-website');

        // routes of the website information
        Route::prefix('information')->name('information.')->controller(InformationController::class)->group(function () {
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-website-information')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-website-information')->name('update');
        });

        // routes of privacy policies
        Route::prefix('privacy-policies')->name('privacy-policies.')->controller(PrivacyPolicyController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-privacy-policies')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-privacy-policy')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-privacy-policy')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-privacy-policy')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-privacy-policy')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-privacy-policy')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-privacy-policy')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-privacy-policy')->name('toggle-status');
        });

        // routes of termns and conditions
        Route::prefix('terms-conditions')->name('terms-conditions.')->controller(TermConditionController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-terms-conditions')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-term-condition')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-term-condition')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-term-condition')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-term-condition')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-term-condition')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-term-condition')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-term-condition')->name('toggle-status');
        });

        // routes of contact informations
        Route::prefix('contact-informations')->name('contact-informations.')->controller(ContactInformationController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-contact-informations')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-contact-information')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-contact-information')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-contact-information')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-contact-information')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-contact-information')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-contact-information')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-contact-information')->name('toggle-status');
        });

        // routes of social links
        Route::prefix('social-links')->name('social-links.')->controller(SocialLinkController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-social-links')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-social-link')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-social-link')->name('store');
            Route::get('{id}', 'show')->middleware('hasPermission:view-social-link')->name('show');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-social-link')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-social-link')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-social-link')->name('destroy');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-social-link')->name('toggle-status');
        });

        // routes of meta pages
        Route::prefix('meta-pages')->name('meta-pages.')->controller(MetaPageController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-meta-pages')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-meta-page')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-meta-page')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-meta-page')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-meta-page')->name('update');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-meta-page')->name('destroy');
        });

        // routes of footer sections
        Route::prefix('footer-sections')->name('footer-sections.')->controller(FooterSectionController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-footer-sections')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-footer-section')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-footer-section')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-footer-section')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-footer-section')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-footer-section')->name('toggle-status');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-footer-section')->name('destroy');
        });

        // routes of the footer links
        Route::prefix('footer-sections')->name('footer-links.')->controller(FooterLinkController::class)->group(function () {
            Route::get('{footer_section_id}/footer-links', 'index')->middleware('hasPermission:listing-footer-links')->name('index');
            Route::get('{footer_section_id}/footer-links/create', 'create')->middleware('hasPermission:create-footer-link')->name('create');
            Route::post('{footer_section_id}/footer-links', 'store')->middleware('hasPermission:create-footer-link')->name('store');
            Route::get('{footer_section_id}/footer-links/{id}/edit', 'edit')->middleware('hasPermission:update-footer-link')->name('edit');
            Route::put('{footer_section_id}/footer-links/{id}', 'update')->middleware('hasPermission:update-footer-link')->name('update');
            Route::put('{footer_section_id}/footer-links/{id}/toggle', 'toggle')->middleware('hasPermission:update-footer-link')->name('toggle-status');
            Route::delete('footer-links/{id}', 'destroy')->middleware('hasPermission:delete-footer-link')->name('destroy');
        });

        // routes of FAQs
        Route::prefix('faqs')->name('faqs.')->controller(FAQController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-faqs')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-faq')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-faq')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-faq')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-faq')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-faq')->name('toggle-status');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-faq')->name('destroy');
        });

        // routes of Blogs
        Route::prefix('blogs')->name('blogs.')->controller(BlogController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-blogs')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-blog')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-blog')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-blog')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-blog')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-blog')->name('toggle-status');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-blog')->name('destroy');
        });

        // routes of Main Sliders
        Route::prefix('main-sliders')->name('main-sliders.')->controller(MainSliderController::class)->group(function () {
            Route::get('', 'index')->middleware('hasPermission:listing-main-sliders')->name('index');
            Route::get('create', 'create')->middleware('hasPermission:create-main-slider')->name('create');
            Route::post('', 'store')->middleware('hasPermission:create-main-slider')->name('store');
            Route::get('{id}/edit', 'edit')->middleware('hasPermission:update-main-slider')->name('edit');
            Route::put('{id}', 'update')->middleware('hasPermission:update-main-slider')->name('update');
            Route::put('{id}/toggle', 'toggle')->middleware('hasPermission:update-main-slider')->name('toggle-status');
            Route::delete('{id}', 'destroy')->middleware('hasPermission:delete-main-slider')->name('destroy');
        });
    });
});
