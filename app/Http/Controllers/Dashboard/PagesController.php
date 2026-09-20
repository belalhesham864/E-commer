<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageRequest;
use App\Services\Dashboard\PagesService;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct(private PagesService $pagesService) {}
    public function getAll()
    {
        return $this->pagesService->getAll();
    }
    public function index()
    {
        return view('dashboard.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();
        $page = $this->pagesService->createPage($data);
        if (!$page) {
        flash()->error('error please try again latter');
        return redirect()->back();
        }
     flash()->success('page Created Successfuly');
     return redirect()->route('dashboard.pages.index');
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
        $page = $this->pagesService->getpage($id);
        if (!$page) {
         flash()->error('error please try again latter');
        return redirect()->back();
        }
      return view('dashboard.pages.edit',compact('page'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        $data = $request->validated();
        $page = $this->pagesService->updatepage($id, $data);
         if (!$page) {
        flash()->error('error please try again latter');
        return redirect()->back();
        }
     flash()->success('page Updated Successfuly');
     return redirect()->route('dashboard.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = $this->pagesService->deletepage($id);
        if (!$page) {
            return response()->json(['status' => false, 'msg' => 'page not found or error occurred'], 400);
        }
        return response()->json(['status' => true, 'msg' => 'page Deleted Successfully']);
    }

    public function deleteImage(string $id)
    {
        $deleted = $this->pagesService->deleteImage($id);
        if (!$deleted) {
            return response()->json(['error' => 'Failed to delete image or page not found'], 400);
        }
        return response()->json(['success' => true]);
    }
}
