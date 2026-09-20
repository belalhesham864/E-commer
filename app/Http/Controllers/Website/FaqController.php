<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\faqRequest;
use App\Models\Faqs;
use App\Services\website\FAQService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(private FAQService $faqservice){}
    public function index(){
        $faqs=$this->faqservice->getFaqs();
        return view('website.faq',compact('faqs'));
    }

}
