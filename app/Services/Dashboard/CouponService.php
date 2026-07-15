<?php

namespace App\services\Dashboard;

use App\Repositories\Dashboard\CouponRepository;
use Yajra\DataTables\Facades\DataTables;

class CouponService
{
      public function __construct(private CouponRepository $couponRepository) {}
        public function getAll(){
    $coupons=$this->couponRepository->getAll();
   return DataTables::of($coupons)
    ->addIndexColumn()
    ->addColumn('action',function($coupon){
      return view('dashboard.coupon.action',compact('coupon'));
    })
    ->make(true);
  }
  public function getCouponById($id){
    $coupon=$this->couponRepository->getCouponById($id);
    return $coupon;
  }
  public function createCoupon($data){

    return $this->couponRepository->createCoupon($data);
  }
  
  public function updateCoupon($id,$data){
   $coupon=self::getCouponById($id);
   return $this->couponRepository->updateCoupon($coupon,$data);
  }
  public function deleteCoupon($id){
         $coupon=self::getCouponById($id);
    return $this->couponRepository->deleteCoupon($coupon);
  }

}
 