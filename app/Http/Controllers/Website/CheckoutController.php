<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\OrderShippingRequest;
use App\services\website\OrderServices;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(private OrderServices $orderServices){}
    public function index(){
        return view('website.check-out');
    }

    public function checkout(OrderShippingRequest $request){
        $data=$request->validated();
       $createOrder=$this->orderServices->createOrder($data);
   if(!$createOrder){
    session()->flash('error','Something went wrong');
    return redirect()->back();
    }
    session()->flash('success','Order Created Successfuly');
    return redirect()->back();
    }
}
