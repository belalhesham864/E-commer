<?php

namespace App\Livewire\Website\wishlist;

use Livewire\Component;
use App\Models\Wishlist as ModelWishlist;
use function Flasher\Prime\flash;

class Wishlist extends Component
{
   public $product,$inwishlist,$type='details';
   public function mount($product){
    $this->product=$product;
    if(auth('web')->check()){

        $status=ModelWishlist::where('product_id',$product->id)->where('user_id',auth('web')->user()->id)->first();
        $status ? $this->inwishlist=true : $this->inwishlist=false;
        }
   }

   public function addToWishList($productId){
    if(!auth('web')->check()){
flash()->info('You must log in first');
        return redirect()->route('login');
    }
    ModelWishlist::firstOrCreate([
        'product_id'=>$productId,
        'user_id'=>auth('web')->user()->id
    ]);
    $this->inwishlist=true;
 $this->dispatch('action-wishlist');

   }
   public function removeInWishlist($productId){
    if(!auth('web')->check()){
flash()->info('You must log in first');
        return redirect()->route('login');
    }
   $wishlistProduct= ModelWishlist::where('product_id',$productId)->where('user_id',auth('web')->user()->id)->first();
   $wishlistProduct->delete();
       $this->inwishlist=false;
 $this->dispatch('action-wishlist');

   }

    public function render()
    {
        return view('livewire.website.wishlist.wishlist');
    }
}
