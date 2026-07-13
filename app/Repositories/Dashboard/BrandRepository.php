<?php

namespace App\Repositories\Dashboard;

use App\Models\Brand;

class BrandRepository
{
    public function getAllBrands(){
         return Brand::select('id','name','logo','slug','status','created_at')->latest()->withCount('products');
    }
    public function findBrandById($id){
        return Brand::findOrFail($id);
    }
    public function create($brand){
        $brand=Brand::create($brand);
        return $brand;
    }
    public function updateBrand($brand,$data){
     $brand->update($data);
     return $brand;
    }
    public function changeStatus($brand){
      $brand->status =$brand->status ? 0 :1;
      $brand->save();
      return $brand;
    }
    public function Delete($brand){
     return $brand->delete();
    }
}
