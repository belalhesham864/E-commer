<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\WorldController;
use App\Notifications\Dashboard\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
	[
		'prefix' => LaravelLocalization::setLocale() . '/dashboard',
		'as' => 'dashboard.',
		'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
	],
	function () {

		##############################Auth#######################
		Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
		Route::post('login', [LoginController::class, 'login'])->name('login.store');
		Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
		Route::prefix('password')->name('password.')->group(function () {
			Route::controller(ForgetPasswordController::class)->group(function () {
				Route::get('email', 'email')->name('email');
				Route::post('email', 'sendOtp')->name('email.post');
				Route::get('sendOtpAgain/{email}', 'sendOtpAgain')->name('email.sendotpAgain');
				Route::get('confirm', 'confirm')->name('confirm');
				Route::post('verify-otp', 'verifyOtp')->name('verify-otp');
			});
			Route::controller(ResetPasswordController::class)->prefix('resetPassword')->group(function () {
				Route::get('/', 'showForm')->name('showform');
				Route::post('/', 'resetPassword')->name('resetPassword');
			});
		});

		##############################Protected Routes#######################
		Route::middleware('auth:admin')->group(function () {

			##############################welcome Routes#######################

			Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');

			##############################Roles Routes#######################

			Route::resource('roles', RoleController::class)->middleware('can:roles');
			##############################admins Routes#######################
			Route::middleware('can:admins')->group(function () {

				Route::resource('admins', AdminController::class);
				Route::get('admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.status');
				Route::post('admins/{id}/password', [AdminController::class, 'changePassword'])->name('admins.password');
				Route::post('admins/search', [AdminController::class, 'search'])->name('admins.search');
			});
			##############################world Routes#######################

			Route::controller(WorldController::class)->middleware('can:World')->name('world.')->group(function () {
				Route::prefix('countries')->name('countries.')->group(function () {

					Route::get('/', 'getAllCountries')->name('index');
					Route::get('/{country_id}/Governrares', 'getAllgovernrates')->name('governrates.index');
					Route::get('/change-Status/{id}', 'changStatus')->name('status');
				});

				Route::prefix('governrate')->name('governrate.')->group(function () {
					Route::get('/change-Status/{id}', 'changStatusgov')->name('status');
					Route::PUT('/change-price/{id}', 'changeprice')->name('price');
				});
			});
			##############################Category Routes#######################
			Route::middleware('can:categories')->group(function () {
				Route::resource('categories', CategoryController::class)->except('show');
				Route::get('categories-all', [CategoryController::class, 'getAll'])->name('categories.all');
				Route::patch('categories/status/{id}', [CategoryController::class, 'changeStatus'])->name('category.status');
			});


			##############################Brand Routes#######################
			Route::middleware('can:brands')->group(function () {
				Route::resource('brands', BrandController::class);
				Route::get('brands-all', [BrandController::class, 'getAll'])->name('brands.all');
				Route::patch('brands/status/{id}', [BrandController::class, 'changeStatus'])->name('brands.status');
			});
			##############################Coupon Routes#######################
			Route::middleware('can:coupons')->group(function () {
				Route::resource('coupons', CouponController::class);
				Route::get('coupons-all', [CouponController::class, 'getAll'])->name('coupons.all');
			});
			##############################Faqs Routes#######################

			Route::middleware('can:faqs')->group(function () {
				Route::resource('faqs', FaqController::class);
				Route::get('faqs-all', [FaqController::class, 'getAll'])->name('faqs.all');
			});
		});
	}
);
