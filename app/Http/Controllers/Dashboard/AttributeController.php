<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AttributeRequest;
use App\services\Dashboard\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function __construct(private AttributeService $attributeService) {}
    public function index()
    {
        return view('dashboard.products.attribute.index');
    }
    public function getAll()
    {
        return $this->attributeService->getAll();
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->validated();
        $create = $this->attributeService->createAttribute($data);
        if (!$create) {
            return response()->json(['status' => false, 'msg' => 'error please try again latter'], 404);
        }
        return response()->json(['status' => true, 'msg' => 'Attribute created success'], 201);
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
        $attr = $this->attributeService->findAttribute($id);
        if (!$attr) {
            return response()->json(['status' => false, 'msg' => 'error please try again latter'], 404);
        }
        return response()->json(['status' => true, 'attr' => $attr], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, string $id)
    {
        $data = $request->validated();
        $create = $this->attributeService->updateAttribute($id, $data);
        if (!$create) {
            return response()->json(['status' => false, 'msg' => 'error please try again latter'], 404);
        }
        return response()->json(['status' => true, 'msg' => 'Attribute Updated success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attr = $this->attributeService->deleteAttribute($id);
        if (!$attr) {
            return response()->json(['status' => false, 'msg' => 'error please try again latter'], 404);
        }
        return response()->json(['status' => true, 'msg' => 'Attribute deleted success'], 200);
    }
}
