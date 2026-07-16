<?php

namespace App\services\Dashboard;

use App\Repositories\Dashboard\FaqRepository;

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
    public function findFaq($id)
    {
        return $this->faqRepository->findFaq($id);
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
}
