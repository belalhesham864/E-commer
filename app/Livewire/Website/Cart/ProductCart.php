<?php

namespace App\Livewire\Website\Cart;

use App\Models\cart;
use App\Models\cartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCart extends Component
{
    public $product, $cartQuantity = 1;
    public function mount($product)
    {
        $this->product = $product;
    }

    #[On('change-cart-quantity')]
    public function updateQuantity($quantity)
    {
        $this->cartQuantity = $quantity;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            flash()->info('You must log in first');
            return redirect()->route('login');
        }
        $product = $this->product;
        $userId = auth('web')->user()->id;
        $cart = cart::firstOrCreate(['user_id' => $userId]);

        if (!$product->has_variants) {
            $cartItem = cartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->whereNull('product_variant_id')
                ->first();
            if ($cartItem) {
                if ($cartItem->quantity + $this->cartQuantity > $product->quantity) {
                    $this->dispatch('error-message', 'The quantity you want add exceeds the stock');
                    return false;
                }
                $cartItem->increment('quantity', $this->cartQuantity);
            } else {
                if($this->cartQuantity > $product->quantity){
                    $this->dispatch('error-message', 'The quantity you want add exceeds the stock');
                    return false;
                }
                $cart->cartItems()->create([
                    'user_id'=>auth('web')->user()->id,
                    'product_id'=>$product->id,
                    'product_variant_id'=>null,
                    'price'=>$product->price,
                    'quantity'=>$this->cartQuantity,
                    'attributes'=>null,
                ]);
            }

        }








        if ($product->has_variants) {
        }


        $this->dispatch('success-message','Product Add To Cart Successfuly ');
    }



    public function render()
    {

        return view('livewire.website.cart.product-cart');
    }
}
