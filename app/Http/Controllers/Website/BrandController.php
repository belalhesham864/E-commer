<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
       public function __construct(private HomeService $homeService){}
    public function index(){
        $brands=$this->homeService->getBrands();
      return view('website.brands',compact('brands'));
    }
    public function getProductByBrand($slug){
        $products=$this->homeService->getProductByBrand($slug);
        
           return view('website.products',compact('products'));
               }
}
