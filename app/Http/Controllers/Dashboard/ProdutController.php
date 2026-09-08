<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use App\Models\productVarient;
use App\services\Dashboard\AttributeService;
use App\Services\Dashboard\BrandServices;
use App\Services\Dashboard\CategoryServices;
use App\Services\Dashboard\ProductServices;
use Illuminate\Http\Request;

class ProdutController extends Controller
{

 public function __construct(private ProductServices $productServices,private CategoryServices $categoryServices,private BrandServices $brandServices,private AttributeService $attributeService){}
  public function getAll(){
      return $this->productServices->getAll();
  }
    public function index()
    {
        return view('dashboard.products.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=$this->categoryServices->getAllcategories();
        $brands=$this->brandServices->Brands();
        $product_attributes=$this->attributeService->getAllAttribute();

        return view('dashboard.products.product.create',compact('categories','brands','product_attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=$this->productServices->getProduct($id);
        return view('dashboard.products.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $categories=$this->categoryServices->getAllcategories();
        $brands=$this->brandServices->Brands();
        $product_attributes=$this->attributeService->getAllAttribute();
        return view('dashboard.products.product.edit',compact('categories','brands','product_attributes','id'));

    }
    public function changeStatus(Request $request){
        $status=$this->productServices->changeStatus($request->product_id);
        if($status){
        return response()->json([
            'status'=>'success',
            'msg'=>'Status Changed Successfuly'
        ]);
        }
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
    public function destroy($id)
    {
             $product=$this->productServices->delete($id);
        if($product){
        return response()->json([
            'status'=>'success',
            'msg'=>'Product Deleted Successfuly'
        ]);
        }
    }
        public function deleteVarient(string $id)
    {

    $result=$this->productServices->deleteVarient($id);
        if ($result===null) {
        return response()->json([
            'status' => 'error',
            'msg' => 'Variant not found'
        ], 404);
    }

   if ($result ==false) {
        return response()->json([
            'status' => 'error',
            'msg' => 'You cannot delete the last variant of this product.'
        ], 422);
    }

            return response()->json([
            'status'=>'success',
            'msg'=>'Varient Deleted Successfuly'
        ]);
        }
}
