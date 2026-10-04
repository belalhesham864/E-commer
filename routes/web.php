<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\website\AboutUsController;
use App\Http\Controllers\Website\BrandController;
use App\Http\Controllers\website\Cartcontroller;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\website\CheckoutController;
use App\Http\Controllers\website\FaqController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\website\pageController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\website\WishlistController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect()->route('Home.index');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/website',
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
        Route::get('product/show/{slug}', [ProductController::class, 'show'])->name('product.show');
        Route::get('page/{slug}', [pageController::class, 'index'])->name('website.page');
        Route::get('product/{type}', [ProductController::class, 'getProductByType'])->name('product.by.type');
        Route::get('{slug}/product', [ProductController::class, 'getRelatedProduct'])->name('product.related');



        Route::get('shop', [HomeController::class, 'showShopPage'])->name('shop');

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
            Route::get('wishlist', WishlistController::class)->name('wishlist');
            Route::get('cart', Cartcontroller::class)->name('cart');
            Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout.post');
            Route::get('checkout/callback',[CheckoutController::class,'callback'])->name('checkout.callback');
            Route::get('checkout/error',[CheckoutController::class,'error'])->name('checkout.error');
        });
    }
);




            Route::get('checkout/callback',[CheckoutController::class,'callback'])->name('checkout.callback');
            Route::get('checkout/error',[CheckoutController::class,'error'])->name('checkout.error');

































// $postFields = [
//     //Fill required data
//     'InvoiceValue'       => $invoiceValue,
//     'CustomerName'       => 'fname lname',
//     'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
//Fill optional data
//'DisplayCurrencyIso' => $displayCurrencyIso,
//'MobileCountryCode'  => $phone[0],
//'CustomerMobile'     => $phone[1],
//'CustomerEmail'      => 'email@example.com',
//'CallBackUrl'        => 'https://example.com/callback.php',
//'ErrorUrl'           => 'https://example.com/callback.php', //or 'https://example.com/error.php'
//'Language'           => 'en', //or 'ar'
//'CustomerReference'  => 'orderId',
//'CustomerCivilId'    => 'CivilId',
//'UserDefinedField'   => 'This could be string, number, or array',
//'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
//'CustomerAddress'    => $customerAddress,
//'InvoiceItems'       => $invoiceItems,
//'Suppliers'          => $suppliers,
// ];


Route::get('test', function () {
    $responce = Http::withHeaders(['Authorization' => 'Bearer SK_KWT_vVZlnnAqu8jRByOWaRPNId4ShzEDNt256dvnjebuyzo52dXjAfRx2ixW5umjWSUx'])
        ->timeout(30)
        ->withoutVerifying()
        ->send('POST', 'https://apitest.myfatoorah.com/v2/SendPayment', [
            'json' => [
                'InvoiceValue'       => 1000,
                'CustomerName'       => 'Belal Hesham',
                'NotificationOption' => 'LNK',

                'DisplayCurrencyIso' => 'EGP',
                'MobileCountryCode'  => '+20',
                'CustomerMobile' => '1028673838',
                'CustomerEmail'      =>  'belalhesham616@gmail.com',
                'CallBackUrl'        => 'http://127.0.0.1:8000/test/callback',
                'ErrorUrl'           => 'http://127.0.0.1:8000/test/error',
                'Language'           => 'en',
            ],
        ]);
    return redirect($responce['Data']['InvoiceURL']);
});

Route::get('test/callback', function () {
    $responce = Http::withHeaders(['Authorization' => 'Bearer SK_KWT_vVZlnnAqu8jRByOWaRPNId4ShzEDNt256dvnjebuyzo52dXjAfRx2ixW5umjWSUx'])
        ->timeout(30)
        ->withoutVerifying()
        ->send('POST', 'https://apitest.myfatoorah.com/v2/GetPaymentStatus', [
            'json' => [
                "Key" => request()->paymentId,
                "KeyType" => "paymentId"
            ],
        ]);
        return $responce->json();
});
Route::get('test/error', function () {
    return request();
});



