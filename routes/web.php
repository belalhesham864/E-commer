<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\website\AboutUsController;
use App\Http\Controllers\Website\BrandController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\website\FaqController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\website\pageController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\website\WishlistController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect()->route('Home.index');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/website',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        // ############################# Public Routes #######################
        Route::resource('Home', HomeController::class);

        Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');

        Route::controller(FaqController::class)->prefix('faq')->name('website.faq')->group(function () {
            Route::get('', 'index');
            Route::post('', 'store')->name('.store');
        });

        Route::controller(BrandController::class)->prefix('brands')->name('brands.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{slug}/products', 'getProductByBrand')->name('product');
        });

        Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{slug}/products', 'getProductByCategory')->name('product');
        });
     Route::get('product/show/{slug}',[ProductController::class,'show'])->name('product.show');
     Route::get('page/{slug}', [pageController::class, 'index'])->name('website.page');
     Route::get('product/{type}',[ProductController::class,'getProductByType'])->name('product.by.type');
     Route::get('{slug}/product',[ProductController::class,'getRelatedProduct'])->name('product.related');



        Route::get('shop',[HomeController::class,'showShopPage'])->name('shop');

        // ############################# Auth (Guests Only) #######################
        Route::middleware('guest')->group(function () {

            Route::controller(RegisterController::class)->prefix('register')->name('register')->group(function () {
                Route::get('', 'showRegistrationForm');
                Route::post('', 'register')->name('.store');
            });

            Route::controller(LoginController::class)->prefix('login')->name('login')->group(function () {
                Route::get('', 'showLoginForm');
                Route::post('', 'login')->name('.store');
            });

            Route::controller(ForgotPasswordController::class)->name('password.')->prefix('forget-password')->group(function () {

                Route::get('', 'showLinkRequestForm')->name('forget');
                Route::post('', 'sendResetLinkEmail')->name('email');
            });

            Route::controller(ResetPasswordController::class)->name('password.')->prefix('reset-password')->group(function () {
                Route::get('/{token}', 'showResetForm')->name('reset');
                Route::post('', 'reset')->name('update');
            });
        });

        // ############################# Authenticated Users Only #######################
        Route::middleware('auth')->group(function () {
            Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
            Route::resource('profile', ProfileController::class);
            Route::get('wishlist',WishlistController::class)->name('wishlist');

        });
    }
);
