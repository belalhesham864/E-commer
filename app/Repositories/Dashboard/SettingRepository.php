<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;

class SettingRepository
{
public function getSetting($id){
    return Setting::findOrFail($id);
}
public function updateSetting($setting,$data){
$setting->update($data);
return $setting;
}

}
