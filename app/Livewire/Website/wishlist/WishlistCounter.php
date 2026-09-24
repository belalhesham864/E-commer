<?php

namespace App\Livewire\Website\wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;


class WishlistCounter extends Component
{    public $count=0;

  public function mount(){
    $this->wishlistCount();
  }

 #[On('action-wishlist')]
   public function wishlistCount(){

      $this->count=Auth::check()?Wishlist::where('user_id',auth('web')->user()->id)->count():0;

   }
    public function render()
    {
        return view('livewire.website.wishlist.wishlist-counter');
    }
}
