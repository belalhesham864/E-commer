<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;
use App\Models\ShippingGovernrate;

class WorldRepository
{

    public function getAllCountries()
    {
        $countries = Country::select('id', 'name', 'phone_code', 'is_active')->get();
        return $countries;
    }
        public function getCountry($id)
    {
        return Country::findOrFail($id);
    }
   

    public function getAllgovernrates($country)
    {
        $governrates = $country->governrates()->when(request()->search,function($q){
        $q->where('name', 'like', '%' . request()->search . '%');
        })
        ->paginate(10);
        return $governrates;
    }
            public function getGovernrate($id)
    {
        return Governrate::findOrFail($id);
    }
    
        public function getAllcities($governrate)
    {
        $cities = $governrate->cities;
        return $cities;
    }

    public function changStatus($country)
    {
       $country->is_active=$country->is_active ? 0:1;
       $country->save();
        return $country;
    }
    public function changStatusgov($governrate)
    {
       $governrate->is_active=$governrate->is_active ? 0:1;
       $governrate->save();
        return $governrate;
    }
    public function getSippingPrice($id){
        $priceGovernrate=ShippingGovernrate::where('governrate_id',$id)->first();
    return $priceGovernrate;
    }
    public function changeprice($priceGovernrate,$shipping_price)
    {  
       $priceGovernrate->price=$shipping_price;
       $priceGovernrate->save();
        return $priceGovernrate;
    }
}
