<?php

namespace App\Repositories\Dashboard;

use App\Models\Coupon;

class CouponRepository
{
  public function getAll(){
    $coupons=Coupon::select('id','code','discount_precentage','start_date','end_date','limit','time_used','is_active','created_at')
    ->latest()
    ->get();
    return $coupons;
  }
  public function getCouponById($id){
    $coupon=Coupon::findOrFail($id);
    return $coupon;
  }
  public function createCoupon($data){
    return Coupon::create($data);
  }
  public function updateCoupon($coupon,$data){
    return $coupon->update($data);
  }
  public function deleteCoupon($coupon){
    return $coupon->delete();
  }

}
 