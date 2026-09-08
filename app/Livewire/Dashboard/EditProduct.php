<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use App\Models\productVarient;
use App\Models\VarientAttribute;
use App\Services\Dashboard\ProductServices;
use App\utils\ImageManger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public $currentStep=1;
    protected ProductServices $productServices;
    public $categories, $brands, $product_attributes, $id;
public $has_discount,$manage_stock,$has_variants ;
public $name,$new_images,$images, $small_desc, $desc, $category_id, $brand_id, $sku, $available_for, $product_tags, $price, $quantity,$discount,$start_discount,$end_discount,$valuerowCount;
 public $variants,$prices=[],$quantities=[],$attributeValues=[];

public $product;
    public function boot(ProductServices $productServices)
    {
        $this->productServices = $productServices;
    }
    public function mount($categories, $brands, $product_attributes, $id)
    {
        $this->product = $this->productServices->getProductwithEgarLoading($id);

        $this->categories = $categories;
        $this->brands = $brands;
        $this->product_attributes = $product_attributes;
       $this->name=$this->product->name;
       $this->images=$this->product->images;
//    dd($this->images);
       $this->small_desc=$this->product->small_desc;
       $this->desc=$this->product->desc;
       $this->category_id=$this->product->category_id;
       $this->brand_id=$this->product->brand_id;
       $this->sku=$this->product->sku;
       $this->available_for=$this->product->available_for;
       $this->price=$this->product->getRawOriginal('price');
       $this->quantity=$this->product->getRawOriginal('quantity');
       $this->discount=$this->product->discount;
       $this->start_discount=$this->product->start_discount;
       $this->end_discount=$this->product->end_discount;
       $this->has_discount=$this->product->has_discount;
       $this->manage_stock=$this->product->manage_stock;
       $this->has_variants=$this->product->has_variants;

       if($this->has_variants==1){
        $this->variants=$this->product->Variants;
            $this->valuerowCount=count($this->variants);
        foreach($this->variants as $key=>$variant ){
            $this->prices[$key]=$variant->price;
            $this->quantities[$key]=$variant->stock;
            foreach($variant->VarientAttributes  as $variantAttribute){
                        $attributeValue = $variantAttribute->AttributeValue;

                $this->attributeValues[$key][$attributeValue->attribute_id]=$attributeValue->id;
            }
        }
       }


    }
    public function rules(){
               return [
        'name' => 'required|string|min:5',
        'small_desc' => 'required|string|min:5',
        'desc' => 'required|string|min:10',
        'category_id' => 'required|exists:categories,id',
         'brand_id' => 'required|exists:brands,id',
          'sku' => 'required|string|unique:products,sku,' . $this->id,
        'available_for' => 'nullable|date',



             'has_variants' => 'required|in:0,1',
         'manage_stock' => 'required|in:0,1',
          'has_discount' => 'required|in:0,1',


        'price' => 'exclude_if:has_variants,1|required_if:has_variants,0|numeric|min:1',
        'quantity' => 'exclude_if:manage_stock,0|required_if:manage_stock,1|numeric|min:1',

        'discount' => 'exclude_if:has_discount,0|required_if:has_discount,1|numeric|min:1',
        'start_discount' => 'exclude_if:has_discount,0|required_if:has_discount,1|date|before:end_discount',
        'end_discount' => 'exclude_if:has_discount,0|required_if:has_discount,1|date|after:start_discount',

        'prices' => 'exclude_if:has_variants,0|required_if:has_variants,1|array|min:1',
        'prices.*' => 'exclude_if:has_variants,0|required_if:has_variants,1|numeric|min:1|max:1000000',

        'quantities' => 'exclude_if:has_variants,0|required_if:has_variants,1|array|min:1',
        'quantities.*' => 'exclude_if:has_variants,0|required_if:has_variants,1|integer|min:1',

        'attributeValues' => 'exclude_if:has_variants,0|required_if:has_variants,1|array|min:1',
        'attributeValues.*' => 'exclude_if:has_variants,0|required_if:has_variants,1|array',
        'attributeValues.*.*' => 'exclude_if:has_variants,0|required_if:has_variants,1|integer|exists:attribute_values,id',



 'new_images' => 'nullable|array',
'new_images.*' => 'image|max:5120',
               ];
    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

public function firstStepSubmit(){
    $this->validate(collect($this->rules())
    ->only(['name','small_desc', 'desc', 'category_id', 'brand_id','sku'])->toArray());

    $this->currentStep=2;
}
public function secondStepSubmit()
{

    $this->validate(
        collect($this->rules())
            ->only(['has_variants','manage_stock','has_discount','price','quantity','discount','start_discount','end_discount','prices','prices.*','quantities','quantities.*','attributeValues','attributeValues.*','attributeValues.*.*',
            ])
            ->toArray()
    );



    $this->currentStep = 3;
}
public function submit()
{
    try{


   if($this->images->isEmpty() && empty($this->new_images)){
    $this->addError('images','this product must have at least one image');
    return;
   }
       $this->resetErrorBag('images');

    $this->validate(
        collect($this->rules())
            ->only(['images','images.*','new_images','new_images.*'])
            ->toArray()
    );



DB::beginTransaction();

 $this->product->update([
            'name'=>$this->name,
            'small_desc'=>$this->small_desc,
            'desc'=>$this->desc,
            'category_id'=>$this->category_id,
            'brand_id'=>$this->brand_id,
            'sku'=>$this->sku,
            'available_for'=>$this->available_for,
            'has_variants'=>$this->has_variants,
            'price'=>$this->has_variants==1 ? null :$this->price ,
            'manage_stock'=>$this->manage_stock,
            'quantity'=>$this->manage_stock==0 ? null :$this->quantity,
            'has_discount'=>$this->has_discount,
            'discount'=>$this->has_discount==0 ? null : $this->discount,
            'start_discount'=>$this->has_discount==0 ? null : $this->start_discount,
            'end_discount'=>$this->has_discount==0 ? null : $this->end_discount
        ]);

        if($this->has_variants){
           foreach($this->product->Variants as $variant){
           $variant->VarientAttributes()->delete();
            }
            $this->product->Variants()->delete();

            foreach($this->prices as $key=>$price){
                $varient=productVarient::create([
                'product_id'=>$this->product->id,
                'price'=>$price,
                'stock'=>$this->quantities[$key]??0
                ]);
                foreach($this->attributeValues[$key] ?? [] as $attr ){
               VarientAttribute::create([
                 'product_varient_id'=>$varient->id,
                'attribute_value_id'=>$attr
               ]);
                }
            }




        }


        if(!empty($this->new_images)){
              $imageManger=new ImageManger();
        $imageManger->uploadImages($this->new_images,$this->product,'products');
        }


$this->resetAll();
$this->dispatch('product-updated');
$this->currentStep=1;
DB::commit();
  }catch(\Exception $e){
    DB::rollBack();
    Log::error("Product Updated File",[
          'product_id' => $this->product->id ?? null,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),

    ]);
    return;

  }
}







public function backStep($step){
    $this->currentStep=$step;
}
public function updatedHasVariants($value)
{
    if ($value == 1 && empty($this->valuerowCount)) {
        $this->valuerowCount = 1;
        $this->prices = [null];
        $this->quantities = [null];
        $this->attributeValues = [[]];
    }
}

   public function addNewVarient(){
       $this->valuerowCount++;
      }
      public function removeVarient(){
       $this->valuerowCount--;
      }
public function deleteImage($key,$imageId,$fileName){
    $this->productServices->deleteProductImage($imageId,$fileName);
    unset($this->images[$key]);
}
public function deleteNewImage($key){
    unset($this->new_images[$key]);
}
    public function render()
    {
        return view('livewire.dashboard.edit-product');
    }
          public function resetAll(){
$this->reset([
    'name',
    'images',
    'new_images',
    'small_desc',
    'desc',
    'category_id',
    'brand_id',
    'sku',
    'available_for',
    'product_tags',
    'price',
    'quantity',
    'discount',
    'start_discount',
    'end_discount',
    'has_discount',
    'manage_stock',
    'has_variants',
    'prices',
    'quantities',
    'attributeValues',
    'valuerowCount',
]);
      }

}
