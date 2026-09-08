<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BrandRepository;
use App\utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class BrandServices
{
    /**
     * Create a new class instance.
     */
    public function __construct(private BrandRepository $brandrepository, private ImageManger $imageManger) {}
    public function Brands(){
        $brands = $this->brandrepository->getAllBrands();
        return $brands;
    }
    public function getAllBrands()
    {
        $brands = $this->brandrepository->getAllBrands();

        return DataTables::of($brands)
            ->addIndexColumn()
            ->editColumn('status', function ($brand) {
                if ($brand->status) {
                    return '<span class="badge badge-primary">' . $brand->getStatusTranslated() . '</span>';
                } else {
                    return '<span class="badge badge-danger">' . $brand->getStatusTranslated() . '</span>';
                }
            })
            ->editColumn('name', function ($brand) {
                return $brand->getTranslation('name', app()->getLocale());
            })
            ->editColumn('logo', function ($brand) {
                return view('dashboard.brands.datatables.logo', compact('brand'));
            })->addColumn('products_count', function ($brand) {

                return $brand->products_count == 0 ? 'Not Found' : $brand->products_count;
            })
            ->addColumn('action', function ($brand) {
                return view('dashboard.brands.datatables.action', compact('brand'));
            })
            ->rawColumns(['status', 'logo'])
            ->make(true);
    }
    public function findBrandById($id)
    {
        return $this->brandrepository->findBrandById($id);
    }
    public function create($brand)
    {
        if (array_key_exists('logo',$brand)&&$brand['logo'] != null) {
            $fileName = $this->imageManger->uploadSingeImage('/', $brand['logo'], 'brands');
            $brand['logo'] = $fileName;
        }
        $create= $this->brandrepository->create($brand);
        Cache::forget('brands_count');
        return $create;
    }
    public function updateBrand($id, $data)
    {
        $brand = self::findBrandById($id);
        if (array_key_exists('logo',$data) && $data['logo'] != null) {
            $this->imageManger->deleteImageFromLocal($brand->logo);
            $fileName = $this->imageManger->uploadSingeImage('/', $data['logo'], 'brands');
            $data['logo'] = $fileName;
        }

        return $this->brandrepository->updateBrand($brand, $data);
    }
    public function changeStatus($id)
    {
        $brand = self::findBrandById($id);

        return $this->brandrepository->changeStatus($brand);
    }
    public function Delete($id)
    {
        $brand = self::findBrandById($id);
        if ($brand['logo'] != null) {
            $this->imageManger->deleteImageFromLocal($brand->logo);
        }
        $delete= $this->brandrepository->Delete($brand);
        Cache::forget('brands_count');
        return $delete;
    }
}
