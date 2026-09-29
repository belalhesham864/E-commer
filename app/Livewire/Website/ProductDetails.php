<?php

namespace App\Livewire\Website;

use Livewire\Component;

class ProductDetails extends Component
{
    public $product, $variantId, $price, $quantity, $variantAttributes = [];

    public function mount($product){
        $this->product = $product;
        $firstVariant = $product->has_variants == 1 ? $product->Variants->first() : null;
        $this->variantId   = $firstVariant?->id;
        $this->price       = $firstVariant ? $firstVariant->price : $product->price;
        $this->quantity    = $firstVariant ? $firstVariant->stock : $product->quantity;

        if ($firstVariant) {
            $this->loadVariantAttributes($firstVariant);
        }
    }

    private function loadVariantAttributes($variant): void
    {
        $variant->load('VarientAttributes.AttributeValue.attribute');
        $this->variantAttributes = $variant->VarientAttributes->map(function ($va) {
            return [
                'name'  => $va->AttributeValue?->attribute?->name,
                'value' => $va->AttributeValue?->value,
            ];
        })->filter(fn($a) => $a['name'])->values()->toArray();
    }

    public function changeVariant($id)
    {
        $selectedVariant = $this->product->Variants->find($id);
        if ($selectedVariant) {
            $this->variantId   = $selectedVariant->id;
            $this->price       = $selectedVariant->price;
            $this->quantity    = $selectedVariant->stock;
            $this->loadVariantAttributes($selectedVariant);
        }
        $this->dispatch('product-variant-id', id: $id);
    }

    public function render()
    {
        return view('livewire.website.product-details', [
            'variant' => $this->product->Variants,
        ]);
    }
}
