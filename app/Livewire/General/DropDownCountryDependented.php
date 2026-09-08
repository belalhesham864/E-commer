<?php

namespace App\Livewire\General;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;
use Livewire\Component;

class DropDownCountryDependented extends Component
{
    public $countryId = null;
    public $governRateId = null;
    public $cityId = null;

    public $countries = [];
    public $governrates = [];
    public $cities = [];

    public function mount()
    {
        $this->countries = Country::get();
    }

    public function updatedCountryId($value)
    {
        $this->governrates = Governrate::where(
            'country_id',
            $value
        )->get();

        $this->governRateId = null;
        $this->cityId = null;
        $this->cities = [];
    }

    public function updatedGovernRateId($value)
    {
        $this->cities = City::where(
            'governrate_id',
            $value
        )->get();

        $this->cityId = null;
    }

    public function render()
    {
        return view('livewire.general.drop-down-country-dependented');
    }
}

