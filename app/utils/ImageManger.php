<?php

namespace App\utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManger{
    public function uploadSingeImage($path,$image,$disk){
        $fileName=$this->generateImageName($image);
       self::storeImageInLocal($image,$path,$fileName,$disk);
        return $fileName;
    }
  public function deleteImageFromLocal($image){
    if(File::exists(public_path($image))){
     File::delete(public_path($image));
    }
  }

    public function generateImageName($image){
    $fileName=Str::uuid().time().$image->getClientOriginalExtension();
    return $fileName;
    }
    public function storeImageInLocal($image,$path,$fileName,$disk){
          $image->storeAs($path,$fileName,['disk'=>$disk]);
    }

}