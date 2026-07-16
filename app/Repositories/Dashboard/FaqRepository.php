<?php

namespace App\Repositories\Dashboard;

use App\Models\Faqs;

class FaqRepository
{
   

    public function getFaqs(){
         return Faqs::select('id','question','answer')->orderByDesc('id')->get();
    }
    public function findFaq($id){
        return Faqs::findOrFail($id);
    }
    public function create($data){
        $Faq=Faqs::create($data);
         return $Faq;
    }
    public function updateFaqs($Faq,$data){
     $Faq->update($data);
     return $Faq;
    }
   
    public function Delete($Faq){
     return $Faq->delete();
    }
}
