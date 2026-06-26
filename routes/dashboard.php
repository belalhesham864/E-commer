<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\WelcomeController;
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

			Route::resource('roles',RoleController::class)->middleware('can:roles');
			##############################Roles Routes#######################
      Route::middleware('can:admins')->group(function(){
		  
		  Route::resource('admins',AdminController::class);
		  Route::get('admins/{id}/status', [AdminController::class,'changeStatus'])->name('admins.status');
		  Route::post('admins/{id}/password', [AdminController::class,'changePassword'])->name('admins.password');
		  Route::post('admins/search', [AdminController::class,'search'])->name('admins.search');
		  });

		});
	}
);
