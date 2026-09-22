<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\services\website\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function __construct(private ProductService $productService){}

    public function show($slug){
     $product=$this->productService->showProduct($slug);
     return view('website.show',compact('product'));
    }

    public function getProductByType($type){
        if($type=='New-Arriavle'){
        $products=$this->productService->newArriavleProduct();

        }elseif($type=='Flash-Timer'){
        $products=$this->productService->flashProductTimer();

        }elseif($type=='Flash-Product'){
         $products=$this->productService->flashProduct();

        }else{
            abort(404);
        }
        return view('website.products',[
            'products'   =>$products,
            'flash_timer'=>  $type=='Flash-Timer'? true:false,
        ]);
    }
}
