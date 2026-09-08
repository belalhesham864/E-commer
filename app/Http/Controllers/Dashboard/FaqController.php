<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FaqsRequest;
use App\services\Dashboard\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
   public function __construct(private FaqService $faqService){}
    public function index()
    {
        $faqs=$this->faqService->getFaqs();
        return view('dashboard.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqsRequest $request)
    {
        $data=$request->validated();
        $faqs=$this->faqService->create($data);
        if(!$faqs){
         return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);
        }
        return response()->json(['status'=>true,'msg'=>'FAQS Created success','faqs'=>$faqs],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faqs=$this->faqService->findFaq($id);
        if(!$faqs){
                return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);
        }
        return response()->json(['status'=>true,'msg'=>'success','faqs'=>$faqs],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqsRequest $request, string $id)
    {
        $data=$request->validated();
        $upadteFaq=$this->faqService->updateFaqs($id,$data);
        if(!$upadteFaq){

               return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);
        }
        return response()->json(['status'=>true,'msg'=>'Faqs Upated success','faqs'=>$upadteFaq],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $faqs=$this->faqService->Delete($id);
           if(!$faqs){
           return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);

        }
        return response()->json(['status'=>true,'msg'=>'faqs Deleted success'],200);
    }
}
