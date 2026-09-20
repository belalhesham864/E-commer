<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\sliderController;
use App\Http\Controllers\website\AboutUsController;
use App\Http\Controllers\website\FaqController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\website\pageController;
use App\Http\Controllers\Website\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect()->route('Home.index');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/website',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        ############################## Public Routes #######################
        Route::resource('Home', HomeController::class);
        Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');
        Route::get('faq', [FaqController::class, 'index'])->name('website.faq');
        Route::post('faq', [FaqController::class, 'store'])->name('website.faq.store');
        Route::get('{slug}', [pageController::class, 'index'])->name('website.page');

        ############################## Auth (Guests Only) #######################
        Route::middleware('guest')->group(function () {
            Route::controller(RegisterController::class)->group(function () {
                Route::get('register',  'showRegistrationForm')->name('register');
                Route::post('register',  'register')->name('register.store');
            });
            Route::controller(LoginController::class)->group(function () {
                Route::get('login',  'showLoginForm')->name('login');
                Route::post('login',  'login')->name('login.store');
            });
            Route::get('forget-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.forget');
            Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
            Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
            Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
        });

        ############################## Authenticated Users Only #######################
        Route::middleware('auth')->group(function () {
            Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
            Route::resource('profile', ProfileController::class);
        });
    }
);
