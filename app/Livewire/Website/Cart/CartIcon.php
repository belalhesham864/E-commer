<?php

namespace App\Livewire\Website\Cart;

use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $count = 0, $cartItems = [];

    public function mount()
    {
        $this->getCountCart();
        $this->getCartItem();
    }
    #[On('cart-icon')]
    public function getCountCart()
    {
        if (!Auth::check()) {
            return $this->count = 0;
        }
        $cart = cart::withCount('cartItems')
            ->where('user_id', auth('web')->user()->id)
            ->first();
        $this->count = $cart ? $cart->cart_items_count : 0;
        $this->getCartItem();
    }
    public function getCartItem()
    {
        if (Auth::check()) {

            $cart = cart::where(
                'user_id',
                auth('web')->user()->id
            )->first();

            if ($cart) {
                $this->cartItems = $cart->cartItems()
                    ->with('product.images')
                    ->get();
            }
        }
    }

      #[On('delete-item-from-cart')]

    public function deleteItemFromCart($ItemId){
        $cart=cart::where('user_id',auth('web')->user()->id)->first();
       $item= $cart->cartItems()->where('id',$ItemId)->delete();
       if(!$item){
        $this->dispatch('error-message','Please Try Again Latter');
            return;
        }
        $this->getCountCart();
$this->getCartItem();
        $this->dispatch('cart-table');
        $this->dispatch('success-message','Item Deleted From Cart Successfuly');

    }
    public function render()
    {

        return view('livewire.website.cart.cart-icon');
    }
}
