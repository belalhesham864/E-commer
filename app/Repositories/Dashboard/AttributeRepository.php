<?php

namespace App\Repositories\Dashboard;

use App\Models\Attribute;

class AttributeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAll(){
        return Attribute::with('attributevalues')->get();
    }
    public function findAttribute($id){
        return Attribute::with('attributevalues')->findOrFail($id);
    }
         public function createAttribute($data){
            return Attribute::create([
                'name'=>$data['name']
            ]);
        }
        public function updateAttribute($attribute,$data){
            $attribute->update([
                'name'=>$data['name']
            ]);
        }
        public function deleteAttribute($attribute){
            return $attribute->delete();
        }
    
}
