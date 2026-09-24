<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\services\website\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function __construct(private ProductService $productService){}

    public function show($slug){
        $product        = $this->productService->showProduct($slug);
        $relatedProduct = $this->productService->getrelatedProductBySlug($slug, 5);
        $relatedProduct = $relatedProduct->getCollection()->reject(fn($item) => $item->id === $product->id)->take(4);
        return view('website.show', compact('product', 'relatedProduct'));
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
    public function getRelatedProduct($slug){
        $products=$this->productService->getrelatedProductBySlug($slug);

        return view('website.products',[
            'products'=>$products,
            'flash_timer'=>false,
        ]);
    }
}
