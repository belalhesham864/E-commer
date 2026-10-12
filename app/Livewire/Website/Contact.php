<?php

namespace App\Livewire\Website;

use App\Models\Admin;
use App\Models\Contact as ModelsContact;
use App\Notifications\ContactUsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Contact extends Component
{
    public $name, $email, $phone, $subject, $message;
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5',
        ];
    }
    public function updated($filed)
    {
        $this->validateOnly($filed);
    }
    public function submitContactForm(){
        $contact=ModelsContact::create([
            'user_id'=>Auth::guard('web')->user()->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'subject'=>$this->subject,
            'message'=>$this->message,
            'is_read'=>0,
            'is_start'=>0,

        ]);
             if(!$contact){
            $this->dispatch('error-message','error , please try again latter');
            return;
            }
        $admins=Admin::all();
        Notification::send($admins,new ContactUsNotification($contact));

            $this->reset('name','email','phone','subject','message');
            $this->dispatch('success-message','Contact Send Successfuly');

    }
    public function render()
    {
        return view('livewire.website.contact');
    }
}
