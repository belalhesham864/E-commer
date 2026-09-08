<?php

namespace App\Repositories\Dashboard;

use App\Models\Contact;

class ContactRepositories
{
  public function getContectById($id){
    return Contact::withTrashed()->find($id);
  }
  public function restoreContect($contect){
    return $contect->restore();
  }
  public function deleteContect($contect){
    return $contect->forceDelete();
  }
  public function archive($contect){
     $contect->delete();
        return $contect;

  }
  public function markIsRead($contect){
   $contect->is_read=1;
   $contect->save();
  }
  public function markunRead($contect){
   $contect->is_read=0;
   $contect->save();
  }
  public function replayMsg($contect){
   $contect->replay_status=1;
   $contect->save();
  }
  public function addToStart($contect){
   $contect->is_start=$contect->is_start ? 0:1;
   $contect->save();
  }
  public function starCount(){
    $starCount=Contact::where('is_start',1)->count();
    return $starCount;
  }
  public function inboxCount(){
    return Contact::count();
  }
  public function readedCount(){
    return Contact::where('is_read',1)->count();
  }
  public function replayCount(){
    return Contact::where('replay_status',1)->count();
  }
  public function trashCount(){
    return Contact::onlyTrashed()->count();
  }
}
