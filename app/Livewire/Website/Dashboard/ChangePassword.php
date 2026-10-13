<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class ChangePassword extends Component
{
        public $screen='dashboard';
      #[On('changePasswordselectScreen')]
    public function updateScreen($screen){
        $this->screen=$screen;
    }
    public function render()
    {
        return view('livewire.website.dashboard.change-password');
    }
}
