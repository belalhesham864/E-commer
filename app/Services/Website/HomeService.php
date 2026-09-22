<?php

namespace App\Services\Website;

use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use App\Models\Slider;
use App\services\website\ProductService;

class HomeService
{

public function __construct(private ProductService $productService){}
        public function getSliders()
    {
        $slider = Slider::latest()->get();
        return $slider;
    }
    public function getCategories($limit = null)
    {
        if ($limit != null) {
            return category::latest()->limit($limit)->get();
        }
        return category::latest()->get();
    }
    public function getBrands($limit = null)
    {
        if ($limit != null) {
            return Brand::latest()->limit($limit)->get();
        }
        return Brand::latest()->get();
    }
      public function getProductByBrand($slug)
    {
        $brand_id=Brand::where('slug',$slug)->first()->id;
        $products=Product::with('images','brand','category')
        ->isActive()
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')
        ->where('brand_id',$brand_id)
        ->paginate(4);

        return $products;
    }
      public function getProductByCategory($slug)
    {
        $category=category::where('slug',$slug)->first();
        $products=$category->products()->with('images','brand','category')
        ->isActive()
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')

        ->paginate(4);
        return $products;
    }


    public function getHomePageProduct($limitArriavle=null,$limitFlash=null,$limitflashtimer=null):array
    {
        return [
            'newArriavle'=>$this->productService->newArriavleProduct($limitArriavle),
            'flashProduct'=>$this->productService->flashProduct($limitFlash),
            'flashProductTimer'=>$this->productService->flashProductTimer($limitflashtimer),
        ];
    }


}
