<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use App\Models\productVarient;
use App\Models\VarientAttribute;
use App\utils\ImageManger;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
  public  $currentStep=1 ;
  public $successMessage='';
  public $categories,$brands,$product_attributes;
public $name,$images, $small_desc, $desc, $category_id, $brand_id, $sku, $available_for, $product_tags, $price, $quantity,$discount,$start_discount,$end_discount;
public $has_discount=0,$manage_stock=0,$has_variants=0 ;
 public $prices=[],$quantities=[],$attributeValues=[];
 public $valuerowCount=1;
    public function render()
    {
        return view('livewire.dashboard.create-product');
    }
    public function mount($categories,$brands,$product_attributes){

        $this->categories=$categories;
        $this->brands=$brands;
        $this->product_attributes=$product_attributes;
    }
    protected function rules(){
       return [
        'name' => 'required|string|min:5',
        'small_desc' => 'required|string|min:5',
        'desc' => 'required|string|min:10',
        'category_id' => 'required|exists:categories,id',
         'brand_id' => 'required|exists:brands,id',
          'sku' => 'required|string|unique:products,sku',
        'available_for' => 'nullable|date',

         'has_variants' => 'required|in:0,1',
         'manage_stock' => 'required|in:0,1',
          'has_discount' => 'required|in:0,1',

          'price' => 'required_if:has_variants,0|numeric|min:1',
          'quantity' => 'required_if:has_variants,0|numeric|min:1',

          'discount' => 'required_if:has_discount,1|numeric|min:1',
           'start_discount' => 'required_if:has_discount,1|date|before:end_discount',
           'end_discount' => 'required_if:has_discount,1|date|after:start_discount',

           'prices' => 'required_if:has_variants,1|array|min:1',
            'prices.*' => 'required_if:has_variants,1|numeric|min:1|max:1000000',
             'quantities' => 'required_if:has_variants,1|array|min:1',
          'quantities.*' => 'required_if:has_variants,1|integer|min:1',
           'attributeValues' => 'required_if:has_variants,1|array|min:1',
           'attributeValues.*' => 'required_if:has_variants,1|array',
             'attributeValues.*.*' => 'required_if:has_variants,1|integer|exists:attribute_values,id',

                'images' => 'required|array|min:1',
                 'images.*' => 'image|max:2048', ];
    }
    public function updated($propertyName){


    if(in_array($propertyName,['start_discount','end_discount'])){
        $this->resetValidation(['start_discount','end_discount']);
        if ($this->start_discount && $this->end_discount) {
            $this->validateOnly('start_discount');
             $this->validateOnly('end_discount');
             }
             return;
    }
        $this->validateOnly($propertyName);
    }
      public function firstStepSubmit()
      {
        $this->validate([
                'name'  => 'required|string|min:5',
        'small_desc'    => 'required|string|min:5',
        'desc'          => 'required|string|min:10',
        'category_id'   => 'required|exists:categories,id',
        'brand_id'      => 'required|exists:brands,id',
        'sku'           => 'required|string|unique:products,sku',
        'available_for' => 'nullable|date',

        ]);
        $this->currentStep=2;
      }
      public function secondStepSubmit()
      {

            $data=[
                'has_variants'=>'required|in:0,1',
                'manage_stock'=>'required|in:0,1',
                'has_discount'=>'required|in:0,1',
            ];
            if($this->has_variants==0){
                $data['price']='required|numeric|min:1';

            if($this->manage_stock==1){
                $data['quantity']='required|numeric|min:1';
            }
            }
            if($this->has_discount==1){
                $data['discount']='required|numeric|min:1';
             $data['start_discount']='required_if:has_discount,1|date|before:end_discount';
            $data['end_discount']='required_if:has_discount,1|date|after:start_discount';
            }
             if($this->has_variants==1){
    $data['prices'] = 'required|array|min:1';
    $data['prices.*'] = 'required|numeric|min:1|max:1000000';

    $data['quantities'] = 'required|array|min:1';
    $data['quantities.*'] = 'required|integer|min:1';

    $data['attributeValues'] = 'required|array|min:1';
    $data['attributeValues.*'] = 'required|array';
    $data['attributeValues.*.*'] = 'required|integer|exists:attribute_values,id';
              }

            $this->validate($data);
            $this->currentStep=3;



      }
      public function thirdStepSubmit(){
        $this->validate([
            'images'=>'required|array',
            ]);
            $this->currentStep=4;
      }
       public function submit(){
        $product=Product::create([
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
        $imageManger=new ImageManger();
        $imageManger->uploadImages($this->images,$product,'products');


   if($this->has_variants){
    foreach($this->prices as $index=>$price){
        $varient=productVarient::create([
            'product_id'=>$product->id,
            'price'=>$price,
            'stock'=>$this->quantities[$index]??0
        ]);
        foreach($this->attributeValues[$index] as $attributeValue){
            VarientAttribute::create([
                'product_varient_id'=>$varient->id,
                'attribute_value_id'=>$attributeValue
            ]);
        }
    }
   }
$this->resetAll();
$this->dispatch('product-created');
        $this->currentStep=1;
      }


      public function backStep($step){
        $this->currentStep=$step;
      }
      public function deleteImage($key){
        unset($this->images[$key]);
      }
      public function addNewVarient(){
       $this->valuerowCount++;
      }
      public function removeVarient(){
       $this->valuerowCount--;
      }
      public function resetAll(){
$this->reset([
    'name',
    'images',
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
