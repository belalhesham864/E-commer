<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;

class ProductCount extends Component
{
        public $cartQuantity=1;
    public function incrementCartQuantity(){
        $this->cartQuantity++;
        $this->dispatch('change-cart-quantity', quantity: $this->cartQuantity);
    }
    public function decrementCartQuantity(){
        if($this->cartQuantity>1){

            $this->cartQuantity--;
            }

        $this->dispatch('change-cart-quantity', quantity: $this->cartQuantity);
    }
    public function render()
    {
        return view('livewire.website.cart.product-count');
    }
}
