<?php

namespace App\services\website;

use App\Models\category;

class CategoryService
{
   public function getCategories(){
    $category=category::latest()->get();
    return $category;
   }
}
