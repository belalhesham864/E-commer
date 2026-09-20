<?php

namespace App\Services\Dashboard;

use App\Models\page;
use App\Repositories\Dashboard\PagesRepositories;
use App\utils\ImageManger;
use Yajra\DataTables\DataTables;

class PagesService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private PagesRepositories $pagesRepositories, private ImageManger $imageManger) {}
    public function getAll()
    {
        $pages = $this->pagesRepositories->getAll();
        return DataTables::of($pages)
        ->addIndexColumn()
            ->editColumn('image', function ($page) {
                return $page->image != null ? view('dashboard.pages.images', compact('page')) : 'No Image';
            })
            ->addColumn('action', function ($page) {
                return view('dashboard.pages.datatables.action',compact('page'));
            })
            ->addColumn('is_active', function ($page) {
                $status=$page->is_active;
                return view('dashboard.pages.datatables.status',compact('status'));
            })
            ->addColumn('content', function ($page) {
                return view('dashboard.pages.datatables.content',compact('page'));
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }
    public function getpage($id)
    {
        $page = $this->pagesRepositories->getpage($id);
        if (!$page) {
            return false;
        }
        return $page;
    }
    public function createPage($data)
    {
        if (array_key_exists('image', $data) && $data['image'] != null) {
            $data['image'] = $this->imageManger->uploadSingeImage('/', $data['image'], 'pages');
        }
        return $this->pagesRepositories->createPage($data);
    }
    public function updatepage($id, $data)
    {
        $page = self::getpage($id);
        if (array_key_exists('image', $data) && $data['image'] != null) {
            if ($page->image != null) {
                $this->imageManger->deleteImageFromLocal($page->image);
            }
            $data['image'] = $this->imageManger->uploadSingeImage('/', $data['image'], 'pages');
        }else{
            unset($data['image']);
        }
        return $this->pagesRepositories->updatepage($page, $data);
    }
    public function deletepage($id)
    {
        $page = self::getpage($id);
        if ($page->image != null) {
            $this->imageManger->deleteImageFromLocal($page->image);
        }
         return $this->pagesRepositories->deletepage($page);
    }
    public function deleteImage($id)
    {
        $page = self::getpage($id);
        if (!$page || !$page->image) {
            return false;
        }

        $this->imageManger->deleteImageFromLocal($page->image);
        return $this->pagesRepositories->updatepage($page, ['image' => null]);
    }
}
