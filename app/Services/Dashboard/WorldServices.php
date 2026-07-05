<?php

namespace App\Services\Dashboard;

use App\Models\Country;
use App\Repositories\Dashboard\WorldRepository;
use phpDocumentor\Reflection\Types\Self_;

class WorldServices
{
    /**
     * Create a new class instance.
     */
    public function __construct(private WorldRepository $worldRepository){}
   
    public function getAllCountries(){
        
        return $this->worldRepository->getAllCountries();
    }

    public function getAllgovernrates($id){
        $country=self::getCountry($id);
        return $this->worldRepository->getAllgovernrates($country);
    }
        public function getAllcities($id){
        $governrate=$this->worldRepository->getGovernrate($id);
        return $this->worldRepository->getAllcities($governrate);
    }
    public function getCountry($id){
        return $this->worldRepository->getCountry($id);
  
    }
    public function changStatus($id){
        $country=self::getCountry($id);
            if (!$country) {
        return false;
    }
        return $this->worldRepository->changStatus($country);
    }
}
