<?php

namespace App\Livewire\Dashboard\Contact;

use App\Services\Dashboard\ContactService;
use Livewire\Attributes\On;
use Livewire\Component;

class ReplayContact extends Component
{

public  $contact, $id,$email,$replayMessage,$subject,$ClientName;
protected ContactService $contectServices;
public function boot(ContactService $contectServices){
    $this->contectServices=$contectServices;
}


        #[On('replay-message-component')]

    public function LunachModal($msgId)
    {

        $this->setDataInAttribute($msgId);

     $this->dispatch('replay-message-component-modal');
    }
    public function setDataInAttribute($msgId){
    $this->contact=$this->contectServices->getContectById($msgId);
    $this->id=$this->contact->id;
    $this->email=$this->contact->email;
    $this->subject=$this->contact->subject;
    $this->ClientName=$this->contact->name;
    }
    public function replayContent(){
        $this->validate([
            'replayMessage' => 'required|string|min:3',
        ]);

        $replayContent=$this->contectServices->replayContact($this->id,$this->replayMessage);
        if(!$replayContent){
            $this->dispatch('replay-fail');
            return;
        }

        $this->reset('replayMessage');
        $this->dispatch('close-modal');
        $this->dispatch('replay-success');
    }
    public function render()
    {
        return view('livewire.dashboard.contact.replay-contact');
    }
}
