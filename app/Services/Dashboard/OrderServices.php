<?php

namespace App\services\dashboard;

use App\Repositories\dashboard\OrderRepository;
use Yajra\DataTables\DataTables;

class OrderServices
{
    /**
     * Create a new class instance.
     */
    public function __construct(private OrderRepository $orderRepository){}

    public function getAll($request){
        $orders = $this->orderRepository->getAll();

        if ($request->filled('status') && $request->status !== 'allStatus') {
            $orders->where('status', $request->status);
        }
        return DataTables::of($orders)
        ->addIndexColumn()
        ->addColumn('status',function($row){
            return view('dashboard.orders.datatables.status',['status'=>$row->status]);
        })
        ->addColumn('coupon',function($row){
            return $row->coupon ?? 'No Coupon';
        })
        ->editColumn('total_price', function($row){
            return number_format($row->total_price, 2) . ' EGP';
        })
        ->editColumn('created_at', function($row){
            return $row->created_at ? $row->created_at->format('Y-m-d H:i') : '';
        })
        ->addColumn('action',function($row){
            return view('dashboard.orders.datatables.action',['order'=>$row]);
        })
        ->make(true);
    }

    public function getById($id){
        return $this->orderRepository->findById($id);
    }

    public function changeStatus($id, $status){
        return $this->orderRepository->updateStatus($id, $status);
    }
    public function delete($id){
        $order = self::getById($id);
        if (!$order || $order->status == 'pending' || $order->status == 'completed') {
            return false;
        }
        $this->orderRepository->delete($order);
        return true;
    }
}
