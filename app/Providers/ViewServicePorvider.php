<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Faqs;
use App\Models\Setting;
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
      if(!Cache::has('contacts_count')){
          Cache::remember('contacts_count',now()->addHour(),function(){
            return Contact::where('is_read',0)->count();
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
        'contacts_count'=>Cache::get('contacts_count'),
      ]);
       });
       $setting=$this->firstOrCreateSetting();
       view()->share([
        'setting'=>$setting
       ]);

    }
    public function firstOrCreateSetting(){
      $getSetting=Setting::firstOr(function(){
        return  Setting::create([
    'site_name'            => 'E-Commerce',
    'site_desc'            => 'Best online shopping platform.',
    'phone'                => '+20 1001234567',
    'address'              => 'Mansoura, Egypt',
    'email'                => 'info@ecommerce.com',
    'email_support'        => 'support@ecommerce.com',
    'facebook_url'         => 'https://facebook.com/ecommerce',
    'twitter_url'          => 'https://twitter.com/ecommerce',
    'youtube_url'          => 'https://youtube.com/@ecommerce',
    'meta_desc'            => 'Best online store for electronics, fashion and more.',
    'logo'                 => 'logo.png',
    'favicon'              => 'favicon.ico',
    'site_copyright'       => '© 2026 E-Commerce. All Rights Reserved.',
    'promotion_video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);
      });
      return $getSetting;
    }
}
