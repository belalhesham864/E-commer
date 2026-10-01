<?php

namespace App\Livewire\Website\Checkout;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;
use Livewire\Component;

class ShippingDetails extends Component
{
        public $countryId = null ,$governRateId = null, $cityId = null, $countries = [], $governrates = [], $cities = [];

    public function mount()
    {
        $this->countries = Country::isActive()->get();
    }

    public function updatedCountryId($value)
    {
        $this->governrates = Governrate::where('country_id',$value)->isActive()->get();
        $this->dispatch('update-price',$this->governRateId);
        $this->governRateId = null;
        $this->cityId = null;
        $this->cities = [];
    }

    public function updatedGovernRateId($value)
    {
        $this->cities = City::where('governrate_id',$value)->get();
        $this->cityId = null;
        if($value){
            $this->dispatch('update-price', $this->governRateId);
        }
    }
    public function render()
    {
        return view('livewire.website.checkout.shipping-details');
    }
}
