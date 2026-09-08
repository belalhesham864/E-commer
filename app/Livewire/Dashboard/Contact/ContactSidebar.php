<?php

namespace App\Livewire\Dashboard\Contact;

use App\Services\Dashboard\ContactService;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactSidebar extends Component
{
    public $screen = 'inbox', $starCount, $inboxCount, $readedCount, $replayCount, $trashCount;

    public function mount() {
        $this->refreshCounts();
    }

    protected ContactService $contectServices;
    public function boot(ContactService $contectServices){
        $this->contectServices = $contectServices;
    }

    public function selectSecreen($screen){
        $this->screen = $screen;
        $this->dispatch('select-screen', $screen);
    }

    #[On('delete-message')]
    #[On('archive-message')]
    #[On('restore-message')]
    #[On('start-message')]
    #[On('refreash-message')]
    public function refreshCounts(){
        $this->inboxCount  = $this->contectServices->inboxCount();
        $this->readedCount = $this->contectServices->readedCount();
        $this->replayCount = $this->contectServices->replayCount();
        $this->starCount   = $this->contectServices->starCount();
        $this->trashCount  = $this->contectServices->trashCount();
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-sidebar');
    }
}
