<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Component;

class Sidebar extends Component
{
    public $screen='dashboard';
    public function selectScreen($screen){
        $this->screen=$screen;
        $this->dispatch('orderselectScreen',$screen);
        $this->dispatch('addressselectScreen',$screen);
        $this->dispatch('changePasswordselectScreen',$screen);
        $this->dispatch('DashboardselectScreen',$screen);
        $this->dispatch('profileInfoselectScreen',$screen);
        $this->dispatch('WhishlistselectScreen',$screen);
        $this->dispatch('payment',$screen);
        $this->dispatch('Reiview',$screen);
    }
    public function render()
    {
        return view('livewire.website.dashboard.sidebar');
    }
}
