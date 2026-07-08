<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\WorldServices;
use Illuminate\Http\Request;

class WorldController extends Controller
{
  public function __construct(private WorldServices $worldServices) {}
  public function getAllCountries()
  {

    $countries = $this->worldServices->getAllCountries();
    return view('dashboard.world.countries', compact('countries'));
  }

  public function getAllgovernrates($id)
  {

    $governrates = $this->worldServices->getAllgovernrates($id);
    if(request()->ajax()){
          return view('dashboard.world.ajax-governreate', compact('governrates'));

    }
    return view('dashboard.world.governreate', compact('governrates'));
  }
  public function getAllcities($id)
  {

    $cities = $this->worldServices->getAllcities($id);
    return view('dashboard.world.cities', compact('cities'));
  }

  public function changStatus($id)
  {
    $country = $this->worldServices->changStatus($id);
    if (!$country) {
      return response()->json(['status' => false, 'msg' => 'Country Not Found'], 404);
    }
    $country = $this->worldServices->getCountry($id);
    $msg = $country->is_active
      ? 'Country Activated Successfully'
      : 'Country Deactivated Successfully';
    return response()->json(['status' => true, 'msg' => $msg, 'data' => $country], 200);
  }
  public function changStatusgov($id)
  {
    $governrate = $this->worldServices->changStatusgov($id);
    if (!$governrate) {
      return response()->json(['status' => false, 'msg' => 'governrate Not Found'], 404);
    }
    $msg = $governrate->is_active
      ? 'governrate Activated Successfully'
      : 'governrate Deactivated Successfully';
    return response()->json(['status' => true, 'msg' => $msg, 'data' => $governrate], 200);
  }

  public function changeprice($id, Request $request)
  {
    $request->validate([
      'shpping_price' => 'required|numeric|min:0'
    ]);
    $price = $this->worldServices->changeprice($id, $request->shpping_price);
    if (!$price) {
    return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);
    }
 return response()->json(['status'=>true,'msg'=>'shipping price change success','data'=>$price],200);
  }
  
}
