<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ProductRepository;
use App\utils\ImageManger;
use Yajra\DataTables\Facades\DataTables;

class ProductServices
{
    /**
     * Create a new class instance.
     */
    public function __construct(private ProductRepository $productRepository, private ImageManger $imageManger) {}
    public function getAll()
    {
        $products = $this->productRepository->getAll();
        return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                $status = $row->status();
                return view('dashboard.products.product.status', compact('status'));
            })
            ->editColumn('has_variants', function ($row) {
                return $row->hasVariants();
            })
            ->addColumn('category', function ($row) {
                return $row->category->name;
            })
            ->addColumn('images', function ($row) {
                return view('dashboard.products.product.images', compact('row'));
            })
            ->addColumn('brand', function ($row) {
                return $row->brand->name;
            })
            ->addColumn('action', function ($row) {
                return view('dashboard.products.product.action', compact('row'));
            })
            ->make(true);
    }
    public function getProductwithEgarLoading($id)
    {
        $product = $this->productRepository->getProductwithEgarLoading($id);
        if (!$product) {
            return false;
        }
        return $product;
    }
    public function getProduct($id)
    {
        $product = $this->productRepository->getProduct($id);
        if (!$product) {
            return false;
        }
        return $product;
    }
    public function changeStatus($productId)
    {
        $product = self::getProduct($productId);
        return $this->productRepository->changeStatus($product);
    }
    public function delete($productId)
    {
        $product = self::getProduct($productId);
        return $this->productRepository->delete($product);
    }
    public function deleteVarient($id)
    {
        $varient = $this->productRepository->findVarient($id);

        if (!$varient) {
            return null;
        }
        $varient_count = $this->productRepository->varientCount($varient);
        if ($varient_count <= 1) {
            return false;
        }
        return $this->productRepository->deleteVarient($varient);
    }
    public function findProductImage($id)
    {
        $image = $this->productRepository->findImage($id);
        if (!$image) {
            return false;
        }
        return $image;
    }
    public function deleteProductImage($id, $fileName)
    {
        $this->imageManger->deleteImageFromLocal('uploads/products' . '/' . $fileName);
        $image = self::findProductImage($id);

        $this->productRepository->deleteProductImage($image);
    }
}
