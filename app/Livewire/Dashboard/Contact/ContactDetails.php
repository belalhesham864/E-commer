<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use App\Services\Dashboard\ContactService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ContactDetails extends Component
{
use WithPagination;
    public $msg, $screen = 'inbox';
    protected ContactService $contectServices;
public function boot(ContactService $contectServices){
    $this->contectServices=$contectServices;
}
    public function mount(){
        $this->msg=Contact::latest()->first();
    }
        #[On('show-message')]
    public function showMessage($msgId)
    {
        $this->msg=Contact::withTrashed()->where('id',$msgId)->first();

    }
        public function replayMsg($msgId)
    {
        $this->contectServices->replayMsg($msgId);
     $this->dispatch('replay-message-component',$msgId);
    }
        public function MarkunReadContact($msgId)
    {
        $this->contectServices->markunRead($msgId);
     $this->dispatch('refreash-message');
    }
        public function addToStart($msgId)
    {
        $this->contectServices->addToStart($msgId);
        $this->dispatch('start-message');
        $this->resetPage();
        $this->msg=$this->contectServices->getContectById($msgId);
    }
    public function deleteMsg($msgId)
    {
      $this->contectServices->deleteContect($msgId);
      $this->dispatch('delete-message');
      $this->msg = $this->getFirstByScreen();
    }

    public function restoreMsg($msgId){
      $this->contectServices->restoreContect($msgId);
      $this->dispatch('restore-message');
      $this->msg = $this->getFirstByScreen();
    }

        public function archiveMsg($id){
       $this->contectServices->archive($id);
      $this->dispatch('archive-message');
      $this->msg = $this->getFirstByScreen();
    }

    private function getFirstByScreen(){
        if($this->screen === 'Trash'){
            return Contact::onlyTrashed()->latest()->first();
        }
        return Contact::latest()->first();
    }

    #[On('select-screen')]
    public function SelectScreen($screen){
        $this->screen = $screen;
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-details');
    }
}
