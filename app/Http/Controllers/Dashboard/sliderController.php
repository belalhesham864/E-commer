<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Services\Dashboard\SliderService;
use Illuminate\Http\Request;

class sliderController extends Controller
{
   public function __construct(private SliderService $sliderService) {}
    public function getAll()
    {
       $sliders=$this->sliderService->getAll();
       return $sliders;
    }
    public function index()
    {
        return view('dashboard.sliders.index');
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
    public function store(SliderRequest $request)
    {
        $data=$request->validated();
       $slider=$this->sliderService->createSlider($data);
       if(!$slider){
          return response()->json(['status'=>false,'msg'=>'error please try again latter'],400);
           }
          return response()->json(['status'=>true,'slider'=>$slider, 'msg'=>'Slider Created Successfuly'],201);
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
        $slider=$this->sliderService->getSlider($id);
          if(!$slider){
          return response()->json(['status'=>false,'msg'=>'error please try again latter'],400);
           }
          return response()->json(['status'=>true,'slider'=>$slider, 'msg'=>'Slider'],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $data = $request->validated();
        $slider = $this->sliderService->updateSlider($data, $id);
        if (!$slider) {
            return response()->json(['status' => false, 'msg' => 'Slider not found or error occurred'], 400);
        }
        return response()->json(['status' => true, 'msg' => 'Slider Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider=$this->sliderService->deleteSlider($id);
        if($slider){
                 return response()->json([
            'status'=>'success',
            'msg'=>'Slider Deleted Successfuly'
        ]);
        }
    }
}
