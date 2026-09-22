<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Slider;
use App\services\website\CategoryService;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private HomeService $homeService){}
     public function index()
    {
        $sliders=$this->homeService->getSliders();
        $categories=$this->homeService->getCategories(12);
        $Brands=$this->homeService->getBrands(12);
        $newArriavle=$this->homeService->newArriavleProduct(8);
        $flashProduct=$this->homeService->flashProduct(12);
        $flashProductTimer=$this->homeService->flashProductTimer(4);
        return view('website.index',compact('sliders','categories','Brands','newArriavle','flashProduct','flashProductTimer'));
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
