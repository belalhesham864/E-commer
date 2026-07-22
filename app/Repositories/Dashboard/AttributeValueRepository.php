<?php

namespace App\Repositories\Dashboard;

class AttributeValueRepository
{
    public function createAttributevalue($attribute,$value){
        $attribute->attributevalues()->create(['value'=>$value]);
    }

    public function updateAttributeValue($attribute,$id,$value){
      $attribute->attributevalues()->where('id',$id)->update(['value'=>$value]);
    }
  
    public function deleteRemovedAttributeValues($attribute,$ids){
        $attribute->attributevalues()->whereNotIn('id',$ids)->delete();
    }
}
