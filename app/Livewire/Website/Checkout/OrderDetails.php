<?php

namespace App\Livewire\Website\Checkout;

use App\Models\cart;
use Livewire\Component;

class OrderDetails extends Component
{
    public function render()
    {
        $cart=cart::with('cartItems.product')->where('user_id',auth('web')->user()->id)->first();
        return view('livewire.website.checkout.order-details',['cartItems'=>$cart->cartItems]);
    }
}
