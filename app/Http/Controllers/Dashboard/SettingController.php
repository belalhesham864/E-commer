<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingRequest;
use App\services\Dashboard\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private SettingService $settingService){}
    public function index(){
        return view('dashboard.settings.index');
    }
    public function updateSetting(SettingRequest $request,$id){
$data=$request->validated();
$setting= $this->settingService->updateSetting($id,$data);
  if (!$setting) {
            flash()->error('Please Try Again Latter');
            return redirect()->back();
        }
        flash()->success('setting Updated Sucessfuly');
        return redirect()->route('dashboard.settings.index');
    }
}
