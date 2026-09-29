<?php

namespace App\Livewire\Website\Cart;

use App\Models\cart as ModelsCart;
use App\services\website\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $cartQuantity=5;
    protected CartService $cartService;
    public function boot( CartService $cartService){
    $this->cartService=$cartService;
    }



  public function clearCart(){
    $cart=ModelsCart::where('user_id',auth('web')->user()->id)->first();
    $cart->cartItems()->delete();
    $this->dispatch('cart-icon');
            $this->dispatch('success-message',' Cart Clear Successfuly');

  }
  public function increaseQuantity($ItemId){
    $cart=ModelsCart::where('user_id',auth('web')->user()->id)->first();
  $cartItem=$cart->cartItems()->find($ItemId);
 $cartItem->quantity++;
 $cartItem->save();

  }
  public function decreaseQuantity($ItemId){
    $cart=ModelsCart::where('user_id',auth('web')->user()->id)->first();
  $cartItem=$cart->cartItems()->find($ItemId);
  if($cartItem->quantity>1){

      $cartItem->quantity--;
      }
 $cartItem->save();

  }

   public function deleteItemFromCart($ItemId){
    $this->dispatch('delete-item-from-cart',$ItemId);
   }
    #[On('cart-table')]

    public function render()
    {
        $cart=$this->cartService->getCart();
        return view('livewire.website.cart.cart',['cartItem'=>$cart->cartItems]);
    }
}
