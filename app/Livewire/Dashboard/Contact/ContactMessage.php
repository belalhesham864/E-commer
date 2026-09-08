<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use App\Services\Dashboard\ContactService;
use Illuminate\Mail\Mailables\Content;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ContactMessage extends Component
{
    use WithPagination;
    public $itemSearch, $openMessageId, $page = 1, $screen = 'inbox';

    protected ContactService $contectServices;
public function boot(ContactService $contectServices){
    $this->contectServices=$contectServices;
}
    public function updatingItemSearch()
    {
        $this->resetPage();
    }
    public function showMessage($msgId)
    {
     $this->contectServices->markIsRead($msgId);
        $this->dispatch('show-message', $msgId);
        $this->openMessageId = $msgId;
        $this->resetPage();
    }
    #[On('delete-message')]
    public function deleteMessage()
    {
        $this->resetPage();
    }
    #[On('archive-message')]
    public function archiveMessage()
    {
        $this->resetPage();
    }
    #[On('restore-message')]
    public function restoreMessage()
    {
        $this->resetPage();
    }
    #[On('start-message')]
    public function StarMessage()
    {
        $this->resetPage();
    }
    #[On('refreash-message')]
    public function refreshMessage()
    {
        $this->resetPage();
    }
    #[On('select-screen')]
    public function SelectScreen($screen)
    {
        $this->screen = $screen;
    }
    public function replayMsg($msgId)
    {
        $this->dispatch('replay-message-component', $msgId);
    }
    public function render()
    {
        if($this->screen=='readed'){
            $messages=Contact::where('is_read',1);
        }elseif($this->screen=='replay'){
            $messages=Contact::where('replay_status',1);
        }
        elseif($this->screen=='Starred'){
            $messages=Contact::where('is_start',1);
        }
        elseif($this->screen=='Trash'){
            $messages=Contact::onlyTrashed();
        }

        else{
            $messages = Contact::query();
        }
        if ($this->itemSearch) {
            $messages->where('email', 'LIKE', '%' . $this->itemSearch . '%');
        }
        return view('livewire.dashboard.contact.contact-message', [
            'messages' => $messages->latest()->paginate(5),
        ]);
    }
}
