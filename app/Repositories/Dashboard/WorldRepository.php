<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;

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
        $governrates = $country->governrates;
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
}
