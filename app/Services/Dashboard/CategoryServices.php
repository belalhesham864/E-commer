<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use App\utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class CategoryServices
{

    public function __construct(private CategoryRepository $categoryRepository,private ImageManger $imageManger) {}

    public function categories($id)
    {
        return $this->categoryRepository->categoriesExecptChild($id);
    }
    public function getAllcategories()
    {
 $categories = $this->categoryRepository->getAll();
 return $categories;
     }
    public function getAll()
    {
        $categories = $this->categoryRepository->getAll();
        return DataTables::of($categories)
            ->addIndexColumn()
            ->editColumn('status', function ($category) {
                if ($category->status) {
                    return '<span class="badge badge-primary">' . $category->getStatusTranslated() . '</span>';
                } else {
                    return '<span class="badge badge-danger">' . $category->getStatusTranslated() . '</span>';
                }
            })
            ->addColumn('name', function ($category) {
                return $category->getTranslation('name', app()->getLocale());
            })
            ->addColumn('icon', function ($category) {
                return view('dashboard.categories.icon',compact('category'));
            })
            ->addColumn('action', function ($category) {
                return view('dashboard.categories.action', compact('category'));
            })->addColumn('products_count', function ($category) {

            return $category->products_count==0 ? 'Not Found' :$category->products_count ;

            })
            ->rawColumns(['status','icon'])
            ->make(true);
    }
    public function findById($id)
    {
        return $this->categoryRepository->findById($id);
    }
    public function categoryParent()
    {
        return $this->categoryRepository->categoryParent();
    }
    public function updateCategory($data)
    {
        $category = self::findById($data['id']);
            if(isset($data['icon'])){
                if($category->icon){
                    $this->imageManger->deleteImageFromLocal($category->icon);
                }
            $data['icon']=$this->imageManger->uploadSingeImage('/',$data['icon'],'categories');
        }else{
            unset($data['icon']);
        }
        return $this->categoryRepository->updateCategory($category, $data);
    }
    public function store($data)
    {
        if(isset($data['icon'])){
            $data['icon']=$this->imageManger->uploadSingeImage('/',$data['icon'],'categories');
        }
        $store= $this->categoryRepository->store($data);
     Cache::forget('categories_count');
return $store;
    }
    public function changeStatus($id)
    {
        $category = self::findById($id);
        return $this->categoryRepository->changeStatus($category);
    }
    public function destroy($id)
    {
        $category = self::findById($id);
        $delete= $this->categoryRepository->destroy($category);
        Cache::forget('categories_count');
        return $delete;
    }
}
