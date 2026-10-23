<?php

namespace App\Livewire\Website\Shop;

use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    #[Url]
    public array $categoryIds = [];

    #[Url]
    public array $brandIds = [];

    #[Url]
    public int $minPrice = 1;

    #[Url]
    public int $maxPrice = 10000;

    #[Url]
    public string $sortBy = 'default';

    #[Computed]
    public function categories()
    {
        return category::active()->withCount('products')->get();
    }

    #[Computed]
    public function brands()
    {
        return Brand::active()->withCount('products')->get();
    }

    public function updatedCategoryIds()
    {
        $this->resetPage();
    }

    public function updatedBrandIds()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    #[On('set-price-range')]
    public function setPriceRange($min, $max)
    {
        $this->minPrice = (int) $min;
        $this->maxPrice = (int) $max;
        $this->resetPage();
    }

    public function removePriceFilter()
    {
        $this->setPriceRange(1, 10000);
        $this->dispatch('reset-price-slider', min: 1, max: 10000);
    }

    public function removeCategoryFilter($catid)
    {
        $this->categoryIds = array_values(
            array_diff($this->categoryIds, [$catid])
        );
        $this->resetPage();
    }

    public function removebrandFilter($brandid)
    {
        $this->brandIds = array_values(
            array_diff($this->brandIds, [$brandid])
        );
        $this->resetPage();
    }

    public function clearAllFilter()
    {
        $this->brandIds = [];
        $this->categoryIds = [];
        $this->minPrice = 1;
        $this->maxPrice = 10000;
        $this->sortBy = 'default';
        $this->resetPage();
        $this->dispatch('reset-price-slider', min: 1, max: 10000);
    }

    #[Computed]
    public function filterProducts()
    {
        return Product::isActive()
            ->with(['category', 'brand', 'images'])
            ->when(!empty($this->categoryIds), fn($q) => $q->whereIn('category_id', $this->categoryIds))
            ->when(!empty($this->brandIds), fn($q) => $q->whereIn('brand_id', $this->brandIds))
            ->where(function ($q) {
                $q->where(function ($query) {
                    $query->where('has_variants', 0)
                        ->where('has_discount', 0)
                        ->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })->orWhere(function ($query) {
                    $query->where('has_variants', 0)
                        ->where('has_discount', 1)
                        ->whereRaw('(price - discount) BETWEEN ? AND ?', [$this->minPrice, $this->maxPrice]);
                })->orWhere(function ($query) {
                    $query->where('has_variants', 1)
                        ->whereHas('Variants', function ($varQuery) {
                            $varQuery->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                        });
                });
            })
            ->when($this->sortBy === 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($this->sortBy === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($this->sortBy === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($this->sortBy === 'default' || empty($this->sortBy), fn($q) => $q->latest())
            ->paginate(12);
    }

    public function render()
    {
        return view(
            'livewire.website.shop.shop-page',
            [
                'product' => $this->filterProducts,
                'categories' => $this->categories,
                'brands' => $this->brands,
            ]
        );
    }
}
