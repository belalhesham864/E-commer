<?php

namespace App\Livewire\Website\Cart;

use App\Models\cart;
use App\Models\cartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCart extends Component
{
    public $product, $cartQuantity = 1, $variantId, $cartAttributesArray = [];
    public function mount($product, $variantId = null)
    {
        $this->product = $product;
        $this->variantId = $variantId ?? ($product->has_variants ? $product->Variants->first()?->id : null);
    }

    #[On('change-cart-quantity')]
    public function updateQuantity($quantity)
    {
        $this->cartQuantity = $quantity;
    }

    #[On('product-variant-id')]
    public function updatevariantId($id = null)
    {
        $this->variantId = $id;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            flash()->info('You must log in first');
            return redirect()->route('login');
        }
        $product = $this->product;
        $userId = auth('web')->user()->id;
        $cart = cart::firstOrCreate(['user_id' => $userId]);

        if (!$product->has_variants) {
            $cartItem = cartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->whereNull('product_variant_id')
                ->first();
            if ($cartItem) {
                if ($cartItem->quantity + $this->cartQuantity > $product->quantity) {
                    $this->dispatch('error-message', 'The quantity you want add exceeds the stock');
                    return false;
                }
                $cartItem->increment('quantity', $this->cartQuantity);
            } else {
                if ($this->cartQuantity > $product->quantity) {
                    $this->dispatch('error-message', 'The quantity you want add exceeds the stock');
                    return false;
                }

                $item = $cart->cartItems()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => null,
                    'price' => $product->has_discount ? $product->getPriceAfterDiscount() : $product->price,
                    'quantity' => $this->cartQuantity,
                    'attributes' => null,
                ]);
                if (!$item) {
                    $this->dispatch('error-message', 'error in Create Please Try Again Latter');
                    return false;
                }
            }

            $this->dispatch('success-message', 'Product Add To Cart Successfuly ');
            $this->dispatch('cart-icon');
        }

        if ($product->has_variants) {
            if (!$this->variantId) {
                $this->variantId = $product->Variants->first()?->id;
            }

            $varient = $this->variantId ? $product->Variants->find($this->variantId) : null;
            if (!$varient) {
                $this->dispatch('error-message', 'Please select a valid variant');
                return false;
            }

            $varient->load('VarientAttributes.AttributeValue.attribute');
            $cartItem = cartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->where('product_variant_id', $varient->id)
                ->first();

            if ($cartItem) {
                if ($cartItem->quantity + $this->cartQuantity > $varient->stock) {
                    $this->dispatch('error-message', 'The quantity you want add exceeds the stock');
                    return false;
                }
                $cartItem->increment('quantity', $this->cartQuantity);
            } else {
                if ($this->cartQuantity > $varient->stock) {
                    $this->dispatch('error-message', 'The quantity you want add exceeds the stock');
                    return false;
                }

                $this->cartAttributesArray = [];
                foreach ($varient->VarientAttributes as $varientAttr) {
                    if ($varientAttr->AttributeValue && $varientAttr->AttributeValue->attribute) {
                        $this->cartAttributesArray[$varientAttr->AttributeValue->attribute->name] = $varientAttr->AttributeValue->value;
                    }
                }

                $item = $cart->cartItems()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => $varient->id,
                    'quantity' => $this->cartQuantity,
                    'price' => $varient->price,
                    'attributes' => $this->cartAttributesArray,
                ]);
                if (!$item) {
                    $this->dispatch('error-message', 'error in Create Please Try Again Latter');
                    return false;
                }
            }

            $this->dispatch('success-message', 'Product Add To Cart Successfuly ');
            $this->dispatch('cart-icon');
        }
    }



    public function render()
    {

        return view('livewire.website.cart.product-cart');
    }
}
