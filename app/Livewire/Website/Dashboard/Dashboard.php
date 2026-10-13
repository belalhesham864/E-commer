<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
        public $screen='dashboard';

    public $user,$deliverd_orders_count,$new_orders_count;
    public function mount($user,$deliverd_orders_count,$new_orders_count){
        $this->new_orders_count=$new_orders_count;
        $this->deliverd_orders_count=$deliverd_orders_count;
        $this->user=$user;
    }
      #[On('DashboardselectScreen')]
    public function updateScreen($screen){
        $this->screen=$screen;
    }
    public function render()
    {
        return view('livewire.website.dashboard.dashboard');
    }
}
