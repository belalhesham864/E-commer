<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandRequest;
use App\Services\Dashboard\BrandServices;
use Illuminate\Http\Request;

class BrandController extends Controller
{
   public function __construct(private BrandServices $brandServices){}
    public function index()
    {
        return view('dashboard.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function getAll(){
        return $this->brandServices->getAllBrands();

    }
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $brand=$request->validated();
           $createBrand=$this->brandServices->create($brand);
        if(!$createBrand){
            flash()->error('Please try again latter');
            return redirect()->back();
            }
            flash()->success('Brand Created Successfuly');
            return redirect()->back();
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
        $brand=$this->brandServices->findBrandById($id);
        return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $data=$request->validated();
        $brand=$this->brandServices->updateBrand($id,$data);
        if(!$brand){
          
        flash()->error('Please try again latter');
            return redirect()->back();
            }
            flash()->success('Brand Updated Successfuly');
            return redirect()->route('dashboard.brands.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand=$this->brandServices->Delete($id);
        if(!$brand){

        flash()->error('Please Try Again Latter');
        return redirect()->route('dashboard.brands.index');
        }
        flash()->success('Brand Deleted Successfuly');
        return redirect()->route('dashboard.brands.index');
    }
    public function changeStatus(string $id)
    {
    $brand=$this->brandServices->changeStatus($id);
        if(!$brand){

        flash()->error('Please Try Again Latter');
        return redirect()->route('dashboard.brands.index');
        }
        flash()->success('Status Brand Updated Successfuly');
        return redirect()->route('dashboard.brands.index');
  
    }
}
