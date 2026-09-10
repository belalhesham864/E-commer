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
    public function updateSetting($id, $data){
        $setting = self::getSetting($id);
        
        if (!empty($data['logo'])) {
            if ($setting->getRawOriginal('logo')) {
                $this->imageManger->deleteImageFromLocal('uploads/settings/' . $setting->getRawOriginal('logo'));
            }
            $data['logo'] = $this->imageManger->uploadSingeImage('/', $data['logo'], 'settings');
        } else {
            unset($data['logo']);
        }

        if (!empty($data['favicon'])) {
            if ($setting->getRawOriginal('favicon')) {
                $this->imageManger->deleteImageFromLocal('uploads/settings/' . $setting->getRawOriginal('favicon'));
            }
            $data['favicon'] = $this->imageManger->uploadSingeImage('/', $data['favicon'], 'settings');
        } else {
            unset($data['favicon']);
        }

        return $this->settingRepository->updateSetting($setting, $data);
    }
}
