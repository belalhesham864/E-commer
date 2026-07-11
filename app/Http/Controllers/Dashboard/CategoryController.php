<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\category;
use App\Services\Dashboard\CategoryServices;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function __construct(private CategoryServices $categoryServices){}
public function index()
    {
        return view('dashboard.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getAll()
    {
        return $this->categoryServices->getAll();       
    }
    public function create()
    {
            $categories=$this->categoryServices->categoryParent();
        return view('dashboard.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data= $request->validated();
        $category=$this->categoryServices->store($data);
        if(!$category){

      flash()->error('Error please try again');
        return redirect()->back();
        }
        flash()->success('Category Created Successfuly');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=$this->categoryServices->findById($id);
        $categories=$this->categoryServices->categories($id);
        return view('dashboard.categories.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
       $data=$request->validated();
       $data['id']=$id;
       $categoryUpdate= $this->categoryServices->updateCategory($data);
       if(!$categoryUpdate){
        flash()->error('Error please try again');
        return redirect()->back();
        }
        flash()->success('Category Updated Successfuly');
        return redirect()->route('dashboard.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=category::findOrFail($id);
        $category->delete();
        flash()->success('Category Deleted Successfuly');
        return redirect()->back();
    }
    public function changeStatus(string $id)
    {
       $status=$this->categoryServices->changeStatus($id);
       if(!$status){
        flash()->error('Please Try Again Latter');
        return redirect()->route('dashboard.categories.index');
        }
        flash()->success('category Updated Successfuly');
        return redirect()->route('dashboard.categories.index');
    }
}
