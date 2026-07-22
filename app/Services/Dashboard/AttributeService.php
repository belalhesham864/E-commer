<?php

namespace App\services\Dashboard;

use App\Repositories\Dashboard\AttributeRepository;
use App\Repositories\Dashboard\AttributeValueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class AttributeService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private AttributeRepository $attributeRepository, private AttributeValueRepository $attributeValue) {}
    public function getAll()
    {
        $attributes = $this->attributeRepository->getAll();

        return   DataTables::of($attributes)
            ->addIndexColumn()
            ->addColumn('attributevalues', function ($item) {
                return view('dashboard.products.attribute.datatable.value', compact('item'));
            })

            ->addColumn('action', function ($item) {
                return view('dashboard.products.attribute.datatable.action', compact('item'));
            })

            ->make(true);
    }
    public function findAttribute($id)
    {
        return $this->attributeRepository->findAttribute($id);
    }
    public function createAttribute($data)
    {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->createAttribute($data);
            foreach ($data['value'] as $value) {

                $this->attributeValue->createAttributevalue($attribute, $value);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('error attributes product: ' . $e->getMessage());
            return false;
        }
    }
    public function updateAttribute($id, $data)
    {
        try {
            DB::beginTransaction();
            $attribute = self::findAttribute($id);
              $ids=array_keys($data['value']??[]);

            $this->attributeValue->deleteRemovedAttributeValues($attribute, $ids);
            $this->attributeRepository->updateAttribute($attribute, $data);
            foreach ($data['value'] as $id => $value) {

                $this->attributeValue->updateAttributeValue($attribute, $id, $value);
            }
            if (!empty($data['new_value'])) {
                foreach ($data['new_value'] as $value) {
                    if (!empty($value)) {
                        $this->attributeValue->createAttributevalue($attribute, $value);
                    }
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('error attributes product: ' . $e->getMessage());
            return false;
        }
    }
    public function deleteAttribute($id){
        $attribute=self::findAttribute($id);
      return  DB::transaction(function()use($attribute){

          return  $this->attributeRepository->deleteAttribute($attribute);
            });

    }
}
