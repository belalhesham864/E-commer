<?php

use App\Http\Middleware\MarkUnReadNotifaction;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then:function(){
           Route::middleware('web')

           ->group(base_path('routes/dashboard.php'));
        }
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->redirectGuestsTo(function(){
            if(request()->is('*/dashboard/*')){
                return route('dashboard.login');
            }
              return route('login');
        });
        $middleware->redirectUsersTo(function(){
              if(request()->is('*/dashboard/login')|| request()->is('*/dashboard/register')){
                return route('dashboard.welcome');
            }else{
                return route('Home.index');
            }
        });

              $middleware->alias([


                  'markUnread' => MarkUnReadNotifaction::class,

            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
