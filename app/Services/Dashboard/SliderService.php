<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SliderRepositories;
use App\utils\ImageManger;
use Yajra\DataTables\DataTables;


class SliderService
{

    public function __construct(private SliderRepositories $sliderRepositories, private ImageManger $imageManger){}
    public function getAll(){
        $sliders=$this->sliderRepositories->getAll();
        return DataTables::of($sliders)
            ->addIndexColumn()
            ->addColumn('file_name', function ($slider) {
                return view('dashboard.sliders.images', compact('slider'));
            })
            ->addColumn('action',function($slider){
           return view('dashboard.sliders.datatables.action', compact('slider'));
            })
            ->rawColumns(['file_name', 'action'])
            ->make(true);
    }
       public function getSlider($id){
    $slider=$this->sliderRepositories->getSlider($id);
    if(!$slider){
        return false;
    }
    return $slider;
   }

   public function createSlider($data){
    $data['file_name']=$this->imageManger->uploadSingeImage('/',$data['file_name'],'sliders');
  $slider=$this->sliderRepositories->createSlider($data);
  return $slider;
   }
   public function updateSlider($data, $id){
     $slider = self::getSlider($id);
     if(!$slider) return false;

     if(isset($data['file_name'])){
         // حذف الصورة القديمة
        $this->imageManger->deleteImageFromLocal($slider->file_name);
         // رفع الصورة الجديدة
         $data['file_name'] = $this->imageManger->uploadSingeImage('/', $data['file_name'], 'sliders');
     } else {
         unset($data['file_name']);
     }

     return $this->sliderRepositories->updateSlider($slider, $data);
   }
   public function deleteSlider($id){
     $slider=self::getSlider($id);
     if($slider->file_name){
        $this->imageManger->deleteImageFromLocal($slider->file_name);
     }
    return $this->sliderRepositories->deleteSlider($slider);
   }
}
