<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function paginationView()
    {
        return 'livewire.website.pagination';
    }

    public $user;
    public $screen = 'dashboard';
    public $selectedOrderId = null;
    public $showDetailsModal = false;

    public function mount($user)
    {
        $this->user = $user;
    }

    #[On('orderselectScreen')]
    public function updateScreen($screen)
    {
        $this->screen = $screen;
        $this->resetPage();
        $this->showDetailsModal = false;
        $this->selectedOrderId = null;
    }

    public function viewOrder($id)
    {
        $this->selectedOrderId = $id;
        $this->showDetailsModal = true;
    }

    public function closeModal()
    {
        $this->showDetailsModal = false;
        $this->selectedOrderId = null;
    }

    public function render()
    {
        $orders = $this->user
            ->orders()
            ->with(['orderItems.product.images', 'transaction'])
            ->latest()
            ->paginate(5);

        $selectedOrder = ($this->showDetailsModal && $this->selectedOrderId)
            ? $this->user->orders()->with(['orderItems.product.images', 'transaction'])->find($this->selectedOrderId)
            : null;

        return view('livewire.website.dashboard.orders', compact('orders', 'selectedOrder'));
    }
}

