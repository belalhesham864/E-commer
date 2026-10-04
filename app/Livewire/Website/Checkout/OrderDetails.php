<?php

namespace App\Livewire\Website\Checkout;

use App\Models\cart;
use App\Models\Coupon as ModelsCoupon;
use App\Models\ShippingGovernrate;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderDetails extends Component
{
    public $shippingPrice = 0;
    public $governRateName = '';

    #[On('update-price')]
    public function getPriceShipping($governRateId)
    {
        if ($governRateId) {
            $shipping = ShippingGovernrate::with('governrate')->where('governrate_id', $governRateId)->first();
            $this->shippingPrice = $shipping ? (float)$shipping->price : 0;
            $this->governRateName = $shipping?->governrate?->name ?? '';
        } else {
            $this->shippingPrice = 0;
            $this->governRateName = '';
        }
    }

    #[On('cart-table')]
    public function render()
    {
        $cart = cart::with('cartItems.product')->where('user_id', auth('web')->user()->id)->first();
        $cartItems = $cart ? $cart->cartItems : collect();

        $originalPrice = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $coupon = null;
        $discountAmount = 0;

        if ($cart && $cart->coupon) {
            $coupon = ModelsCoupon::valid()->where('code', trim($cart->coupon))->first();
            if ($coupon) {
                $discountAmount = ($originalPrice * $coupon->discount_precentage) / 100;
            }
        }

        $subTotalAfterDiscount = $originalPrice - $discountAmount;
        $shipping = (float)($this->shippingPrice ?? 0);
        $totalPrice = $subTotalAfterDiscount + $shipping;

        return view('livewire.website.checkout.order-details', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'originalPrice' => $originalPrice,
            'coupon' => $coupon,
            'discountAmount' => $discountAmount,
            'subTotalAfterDiscount' => $subTotalAfterDiscount,
            'shippingPrice' => $shipping,
            'governRateName' => $this->governRateName,
            'totalPrice' => $totalPrice,
        ]);
    }
}
