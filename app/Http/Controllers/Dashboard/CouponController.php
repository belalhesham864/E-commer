<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\Http\Requests\Dashboard\UpdateCouponRequest;
use App\Models\Coupon;
use App\services\Dashboard\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
       public function __construct(private CouponService $couponServices){}
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  return view('dashboard.coupon.index');
    }
    public function getAll(){
         return $this->couponServices->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {

        $data=$request->validated();

        $coupon=$this->couponServices->createCoupon($data);
        if(!$coupon){
     return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);
        }
        return response()->json(['status'=>true,'msg'=>'coupon created success'],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $coupon=$this->couponServices->getCouponById($id);
       if(!$coupon){
       return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);

       }
               return response()->json(['status'=>true,'msg'=>'coupon created success','coupon'=>$coupon],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, string $id)
    {
                $data=$request->validated();

           $coupon=$this->couponServices->updateCoupon($id,$data);
           if(!$coupon){
       return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);

        }
                    return response()->json(['status'=>true,'msg'=>'coupon updated success','coupon'=>$coupon],200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $coupon=$this->couponServices->deleteCoupon($id);
           if(!$coupon){
           return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);

        }
        return response()->json(['status'=>true,'msg'=>'coupon Deleted success'],201);

    }
}
