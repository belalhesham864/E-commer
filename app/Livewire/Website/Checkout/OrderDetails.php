<?php

namespace App\Livewire\Website\Checkout;

use App\Models\cart;
use App\Models\ShippingGovernrate;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderDetails extends Component
{
    public $shippingPrice=0;

    #[On('update-price')]
    public function getPriceShipping($governRateId){
        $this->shippingPrice=ShippingGovernrate::where('governrate_id',$governRateId)->value('price');
    }

        #[On('cart-table')]
    public function render()
    {
        $cart=cart::with('cartItems.product')->where('user_id',auth('web')->user()->id)->first();
        return view('livewire.website.checkout.order-details',['cartItems'=>$cart->cartItems]);
    }
}
