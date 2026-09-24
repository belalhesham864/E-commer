<?php

namespace App\Livewire\Website;

use Livewire\Component;

class ProductDetails extends Component
{
    public $product,$variantId,$price,$quantity;
    public function mount($product){
    $this->product=$product;
    $firstVariant = $product->has_variants==1 ? $product->Variants->first() : null;
    $this->variantId = $firstVariant?->id;
    $this->price     = $firstVariant ? $firstVariant->price : $product->price;
    $this->quantity  = $firstVariant ? $firstVariant->stock : $product->quantity;
    }


    public function changeVariant($id)
    {
        $selectedVariant = $this->product->Variants->find($id);
        if ($selectedVariant) {
            $this->variantId = $selectedVariant->id;
            $this->price     = $selectedVariant->price;
            $this->quantity  = $selectedVariant->stock;
        }
    }

    public function render()
    {
        return view('livewire.website.product-details',[
            'variant'=>$this->product->Variants,
        ]);
    }
}
