<?php

namespace App\Services\website;

use App\Models\faqQuestion;
use App\Models\Faqs;

class FAQService
{
    /**
     * Create a new class instance.
     */
    public function getFaqs()
    {
       $faqs=Faqs::get();
       return $faqs;
    }
    public function store($data)
    {
       $faqs=faqQuestion::create($data);
       return $faqs;
    }
}
