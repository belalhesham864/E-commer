<?php

namespace App\services\Dashboard;

use App\Repositories\Dashboard\FaqRepository;
use Yajra\DataTables\DataTables;
class FaqService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private FaqRepository $faqRepository) {}
    public function getFaqs()
    {
        return $this->faqRepository->getFaqs();
    }
    public function getFaqsquestion()
    {
        $faqQuetions= $this->faqRepository->getFaqsquestion();
         return DataTables::of($faqQuetions)
               ->addIndexColumn()
     ->addColumn('action',function($faqQuetion){
    return view('dashboard.faqs.action',compact('faqQuetion'));
     })
            ->make(true);

    }
    public function findFaq($id)
    {
        return $this->faqRepository->findFaq($id);
    }
    public function findFaqQuetion($id)
    {
        return $this->faqRepository->findFaqQuetion($id);
    }
    public function create($data)
    {
        return $this->faqRepository->create($data);
    }
    public function updateFaqs($id, $data)
    {
        $Faq = self::findFaq($id);
        return $this->faqRepository->updateFaqs($Faq, $data);
    }

    public function Delete($id)
    {
        $Faq = self::findFaq($id);
        return $this->faqRepository->Delete($Faq);
    }
    public function DeleteFaqQuetion($id)
    {
        $faqQuetion = self::findFaqQuetion($id);
        return $this->faqRepository->DeleteFaqQuetion($faqQuetion);
    }
}
