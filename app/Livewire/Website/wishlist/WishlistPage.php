<?php

namespace App\Livewire\Website\wishlist;

use App\services\website\WishlistService;
use Livewire\Attributes\On;
use Livewire\Component;

class WishlistPage extends Component
{
    #[On('action-wishlist')]
    public function refreshWishlist()
    {
    }
  protected WishlistService $wishlistService;
    public function boot(WishlistService $wishlistService){
      $this->wishlistService=$wishlistService;
    }

    public function remove($productId){
        $this->wishlistService->remove($productId);
        $this->dispatch('action-wishlist');
    }
    public function removeAll(){
        $this->wishlistService->removeAll();
        $this->dispatch('action-wishlist');
    }
    public function render()
    {
       $wishlists=$this->wishlistService->getWishlist();
        return view('livewire.website.wishlist.wishlist-page',['wishlists'=>$wishlists]);
    }
}
