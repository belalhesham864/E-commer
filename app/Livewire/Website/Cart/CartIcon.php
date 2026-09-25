<?php

namespace App\Livewire\Website\Cart;

use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartIcon extends Component
{
public $count;
    public function getCountCart(){
        $this->count=Auth::check()?cart::withCount('cartItems')
        ->where('user_id',auth('web')->user()->id)->first():0;
    }
    public function render()
    {
        return view('livewire.website.cart.cart-icon');
    }
}
