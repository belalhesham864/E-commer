<?php

namespace App\Repositories\Dashboard;

use App\Models\page;

class PagesRepositories
{
      public function getAll(){
  return page::latest()->get();
   }
   public function getpage($id){
    return page::find($id);
   }
      public function createPage($data){
    return page::create($data);
   }
   public function updatepage($page,$data){
    return $page->update($data);
   }
   public function deletepage($page){
    return $page->delete();
   }
}
