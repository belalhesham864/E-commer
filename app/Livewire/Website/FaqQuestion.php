<?php

namespace App\Livewire\Website;

use App\Services\website\FAQService;
use Livewire\Component;

class FaqQuestion extends Component
{
    public $name,$email,$subject,$message;
     protected FAQService $faqService;
     public function boot(FAQService $faqService){
        $this->faqService=$faqService;
     }

     public function rules(){
        return[
             'name'=>'required|string',
            'email'=>'required|email',
            'subject'=>'required|string|min:5',
            'message'=>'required|string|min:10'
        ];
     }
     public function updated($propertyName){
     $this->validateOnly($propertyName);
     }

     public function submit(){
       $data= $this->validate();
       $faq=$this->faqService->store($data);
       if(!$faq){

           $this->dispatch('faq-Quetion-failed');
           }
           $this->reset();
           $this->dispatch('faq-Quetion-created');

     }
    public function render()
    {
        return view('livewire.website.faq-question');
    }
}
