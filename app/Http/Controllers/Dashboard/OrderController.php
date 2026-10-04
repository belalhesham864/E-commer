<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\services\dashboard\OrderServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderServices $orderServices){}
    public function getAll(Request $request){
        return $this->orderServices->getAll($request);
    }
    public function index(){
        return view('dashboard.orders.index');
    }

    public function show($id){
        $order = $this->orderServices->getById($id);
        return view('dashboard.orders.show', compact('order'));
    }

    public function changeStatus(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:pending,completed,cancelled,delivered'
        ]);

        $order = $this->orderServices->changeStatus($request->order_id, $request->status);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'msg' => 'Order status updated successfully',
                'new_status' => $order->status
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated successfully');
    }
    public function delete($id){
       $order=$this->orderServices->delete($id);
       if(!$order){
           return response()->json(['status'=>false,'msg'=>'You cannot delete an order that is pending or complete'],403);
           }
           return response()->json(['status'=>true,'msg'=>'Order Deleted Successfuly'],200);
    }
}
