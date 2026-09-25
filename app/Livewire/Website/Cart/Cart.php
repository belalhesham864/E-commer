<?php

namespace App\Livewire\Website\Cart;

use App\services\website\CartService;
use Livewire\Component;

class Cart extends Component
{
    public $cartQuantity=5;
    protected CartService $cartService;
    public function boot( CartService $cartService){
    $this->cartService=$cartService;
    }

    public function incrementCartQuantity(){
        $this->cartQuantity++;
    }
    public function decrementCartQuantity(){
        $this->cartQuantity--;
    }
    public function render()
    {
        $cart=$this->cartService->getCart();
        return view('livewire.website.cart.cart',['cart'=>$cart]);
    }
}
