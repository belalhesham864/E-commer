<?php

namespace App\Livewire\Website;

use App\Models\Product;
use App\Models\ProductReview as ModelsProductReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductReview extends Component
{
    public Product $product;
    public $comment = '';

    protected $rules = [
        'comment' => 'required|string|min:3|max:1000',
    ];

    protected $messages = [
        'comment.required' => 'Please enter your review.',
        'comment.min'      => 'Review must be at least 3 characters.',
        'comment.max'      => 'Review cannot exceed 1000 characters.',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addReview()
    {
        if (!Auth::check()) {
            $this->dispatch('error-message', 'Please login first to submit a review.');
            return redirect()->route('login');
        }

        $this->validate();

        ModelsProductReview::create([
            'product_id' => $this->product->id,
            'user_id'    => Auth::id(),
            'comment'    => trim($this->comment),
        ]);

        $this->reset('comment');
        $this->dispatch('review-added');
        $this->dispatch('success-message', 'Review submitted successfully!');
    }

    public function render()
    {
        $reviews = ModelsProductReview::with(['user.country', 'user.city'])
            ->where('product_id', $this->product->id)
            ->latest()
            ->get();

        return view('livewire.website.product-review', [
            'reviews' => $reviews,
        ]);
    }
}
