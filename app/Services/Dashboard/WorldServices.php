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
    public function getgovernrate($id){
       $governrate= $this->worldRepository->getGovernrate($id);
                   if (!$governrate) {
        return false;
    }
    return $governrate;
    }
    public function changStatus($id){
        $country=self::getCountry($id);
            if (!$country) {
        return false;
    }
        return $this->worldRepository->changStatus($country);
    }
    public function changStatusgov($id){
        $governrate=self::getgovernrate($id);

        return $this->worldRepository->changStatusgov($governrate);
    }
    public function getShippingPrice($id){
        $priceGovernrate=$this->worldRepository->getSippingPrice($id);
        if(!$priceGovernrate){
            return false;
        }
        return $priceGovernrate;
    }
    public function changeprice($id,$shipping_price){
    $priceGovernrate=self::getShippingPrice($id);
             return $this->worldRepository->changeprice($priceGovernrate,$shipping_price);

    }
}
