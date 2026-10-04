<?php

namespace App\services\website;

use App\Models\cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Governrate;
use App\Models\Order;
use App\Models\ShippingGovernrate;
use App\Models\Transaction;

class OrderServices
{
    public function createOrder($data)
    {
        $country = $this->getLocationName(Country::class, $data['country_id']);
        $governrate = $this->getLocationName(Governrate::class, $data['governrate_id']);
        $city = $this->getLocationName(City::class, $data['city_id']);

        if (!$country || !$governrate || !$city) {
            return false;
        }
        $cart = $this->getUserCart();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return false;
        }
        $price = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);
        $subTotal = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->shippingGovarnRate($data['governrate_id']);
        if ($coupon_exsit = $cart->coupon != null) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_precentage / 100);
            }
        }
        $TotalPrice = $subTotal + $shippingPrice;



        $order = Order::create([
            'user_id' => auth('web')->user()->id,
            'user_name' => $data['first_name'] . ' ' . $data['last_name'],
            'user_phone' => $data['user_phone'],
            'user_email' => $data['user_email'],
            'country' => $country,
            'governrate' => $governrate,
            'city' => $city,
            'street' => $data['street'],
            'note' => $data['note'],
            'price' => $price,
            'price_after_discount' => $subTotal,
            'shapping_price' => $shippingPrice,
            'total_price' => $TotalPrice,
            'coupon' => $coupon_exsit && $coupon ? $coupon->code : null,
            'coupon_discount' => $coupon_exsit && $coupon ? $coupon->discount_precentage : 0
        ]);
        $this->createOrderItems($order, $cart);
        // $this->clearCart($cart);
        return $order;
    }


    public function getLocationName($model, $id)
    {
        return $model::find($id)?->name;
    }
    public function getUserCart()
    {
        return cart::with('cartItems.product')->where('user_id', auth()->user()->id)->first();
    }
    public function shippingGovarnRate($governrate_id)
    {
        return ShippingGovernrate::where('governrate_id', $governrate_id)->value('price') ?? 0;
    }
    public function createOrderItems($order, $cart)
    {
        foreach ($cart->cartItems as $item) {

            $order->orderItem()->create([
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => $item->product->name,
                'product_desc' => $item->product->desc,
                'product_price' => $item->price,
                'product_quantity' => $item->quantity,
                'data' => json_encode($item->attributes)
            ]);
        }
    }
    public function clearCart($cart)
    {
        $cart->cartItems()->delete();
        $cart->update([
            'coupon' => null
        ]);
    }

    public function getInvoiceValue($data)
    {
        $governrate = $this->getLocationName(Governrate::class, $data['governrate_id']);
        $cart = $this->getUserCart();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return false;
        }
        $subTotal = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->shippingGovarnRate($data['governrate_id']);
        if ( $cart->coupon != null) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_precentage / 100);
            }
        }
        $TotalPrice = $subTotal + $shippingPrice;
        return $TotalPrice;
    }

    public function createTranscation($checkout,$order_id){
        $transcation=Transaction::create([
            'order_id'=>$order_id,
            'user_id'=>auth('web')->user()->id,
            'payment_method'=>'visa',
            'transaction_id'=>$checkout['Data']['InvoiceId']
        ]);
        return $transcation;
    }

}
