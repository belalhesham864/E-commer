<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\category;
use App\Models\Coupon;
use App\Models\Faqs;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServicePorvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('dashboard.*',function(){

      if(!Cache::has('categories_count')){
          Cache::remember('categories_count',now()->addHour(),function(){
            return category::count();
        });
      }
      if(!Cache::has('brands_count')){
          Cache::remember('brands_count',now()->addHour(),function(){
            return Brand::count();
        });
      }
      if(!Cache::has('admins_count')){
          Cache::remember('admins_count',now()->addHour(),function(){
            return Admin::count();
        });
      }
      if(!Cache::has('coupons_count')){
          Cache::remember('coupons_count',now()->addHour(),function(){
            return Coupon::count();
        });
      }
      if(!Cache::has('Faqs_count')){
          Cache::remember('Faqs_count',now()->addHour(),function(){
            return Faqs::count();
        });
      }
      view()->share([
        'categories_count'=>Cache::get('categories_count'),
        'brands_count'=>Cache::get('brands_count'),
        'admins_count'=>Cache::get('admins_count'),
        'coupons_count'=>Cache::get('coupons_count'),
        'Faqs_count'=>Cache::get('Faqs_count'),
      ]);
       });
    }
}
