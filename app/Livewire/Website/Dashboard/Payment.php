<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class Payment extends Component
{
      public $screen='dashboard';
      #[On('payment')]
    public function updateScreen($screen){
        $this->screen=$screen;
    }
    public function render()
    {
        return view('livewire.website.dashboard.payment');
    }
}
