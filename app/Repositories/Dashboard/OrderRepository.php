<?php

namespace App\Repositories\dashboard;

use App\Models\Order;

class OrderRepository
{
    public function getAll(){
        return Order::query()->latest();
    }

    public function findById($id){
        return Order::with(['orderItems.product.images', 'orderItems.productVariant', 'user', 'transaction'])->findOrFail($id);
    }

    public function updateStatus($id, $status){
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);
        return $order;
    }
    public function delete($order){
        $order->delete();
    }
}
