<?php

namespace App\Livewire\Website\Checkout;

use App\Models\cart;
use App\Models\Coupon as ModelsCoupon;
use Livewire\Component;

class Coupon extends Component
{
    public $code, $coupon, $cart, $cartItem;

    public function mount()
    {
        $this->cart = cart::where('user_id', auth('web')->user()->id)->first();
        $this->cartItem = $this->cart ? $this->cart->cartItems()->count() : 0;
        $coupon = ModelsCoupon::valid()->where('code', $this->cart->coupon)->first();
        if ($coupon) {
            $this->coupon = $coupon;
        }
    }

    public function applyCoupon()
    {
        if (!$this->checkCouponVailed($this->code)) {
            $this->dispatch('error-message', 'Coupon Not Vailed');
            return;
        }

        $this->cart->update([
            'coupon' => $this->code,
        ]);
        $this->cart->refresh();

        $coupon = ModelsCoupon::where('code', $this->code)->first();
        $coupon->update([
            'time_used' => $coupon->time_used + 1
        ]);

        $this->coupon = $coupon;
        $this->code = '';

        $this->dispatch('cart-table');
    }

    public function removeCoupon()
    {
        if ($this->coupon) {
            $this->coupon->update([
                'time_used' => max(0, $this->coupon->time_used - 1)
            ]);
        }

        $this->cart->update([
            'coupon' => null
        ]);
        $this->cart->refresh();

        $this->coupon = null;
        $this->code = '';

        $this->dispatch('cart-table');
    }

    public function checkCouponVailed($code)
    {
        $couponobj = ModelsCoupon::where('code', $code)->first();
        if (!$couponobj) {
            return false;
        }
        if (!$couponobj->couponIsValid()) {
            return false;
        }

        return $couponobj;
    }

    public function render()
    {
        return view('livewire.website.checkout.coupon');
    }
}

