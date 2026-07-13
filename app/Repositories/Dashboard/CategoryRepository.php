<?php

namespace App\Repositories\Dashboard;

use App\Models\category;

class CategoryRepository
{
 public function getAll(){
      $categories=category::select('id','name','status','created_at')->withCount('products');
      return $categories;
 }
 public function findById($id){
      $category=category::findOrFail($id);
      return $category;
 }
 public function categoryParent(){
     return category::whereNull('parent')->get();
 }
 public function categoriesExecptChild($id){
     return category::where('id','!=',$id)
     ->whereNull('parent')
     ->get();
 }
 public function updateCategory($category,$data){
    $category->setTranslation('name','en',$data['name']['en']);
    $category->setTranslation('name','ar',$data['name']['ar']);
    $category->status=$data['status'];
    
    $category->parent=$data['parent'] ?? null;
    $category->save();
    return $category;
 }
 public function store($data){
     $category=new category();
      $category->setTranslation('name','en',$data['name']['en']);
    $category->setTranslation('name','ar',$data['name']['ar']);
    $category->status=$data['status'];
    $category->parent=$data['parent'] ?? null;
     $category->save();
    return $category;

 }
 public function changeStatus($category){
      $category->status=$category->status ? 0:1;
      $category->save();
      return $category;
 }
 public function destroy($category){
     return $category->delete();
 
 }
}
