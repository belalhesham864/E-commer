<?php

namespace App\services\Dashboard;

use App\Repositories\Dashboard\SettingRepository;
use App\utils\ImageManger;

class SettingService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private SettingRepository $settingRepository, private ImageManger $imageManger){}
    public function getSetting($id){
        return $this->settingRepository->getSetting($id);
    }
    public function updateSetting($id,$data){
        $setting=self::getSetting($id);
        if(array_key_exists('logo',$data) && $data['logo'] !=null){
            $this->imageManger->deleteImageFromLocal($setting->logo);
         $image=$this->imageManger->uploadSingeImage('/',$data['logo'],'settings');
         $data['logo']=$image;
        }
        if(array_key_exists('favicon',$data) && $data['favicon'] !=null){
            $this->imageManger->deleteImageFromLocal($setting->favicon);
         $image=$this->imageManger->uploadSingeImage('/',$data['favicon'],'settings');
         $data['favicon']=$image;
        }
        return $this->settingRepository->updateSetting($setting,$data);
    }
}
