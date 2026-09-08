<?php

namespace App\Services\Dashboard;

use App\Mail\Dashboard\ReblayContect;
use App\Repositories\Dashboard\ContactRepositories;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private ContactRepositories $contactRepositories){}
      public function getContectById($id){
    $contect=$this->contactRepositories->getContectById($id);
    if(!$contect){
        return false;
    }
    return $contect;
  }
  public function deleteContect($id){
     $contect=self::getContectById($id);
     return $this->contactRepositories->deleteContect($contect);
  }
  public function restoreContect($id){
     $contect=self::getContectById($id);
     return $this->contactRepositories->restoreContect($contect);
  }
  public function archive($id){
     $contect=self::getContectById($id);
     return $this->contactRepositories->archive($contect);
  }
  public function markIsRead($id){
        $contect=self::getContectById($id);
     return $this->contactRepositories->markIsRead($contect);
  }
  public function markunRead($id){
       $contect=self::getContectById($id);
     return $this->contactRepositories->markunRead($contect);
  }
  public function addToStart($id){
       $contect=self::getContectById($id);
     return $this->contactRepositories->addToStart($contect);
  }
  public function replayMsg($id){
       $contect=self::getContectById($id);
     return $this->contactRepositories->replayMsg($contect);
  }
  public function replayContact($id,$replayMessage){
       $contect=self::getContectById($id);
       Mail::to($contect->email)->send(new ReblayContect($contect->name,$replayMessage,$contect->subject));
     return true;
  }
  public function starCount(){
    $starCount=$this->contactRepositories->starCount();
    return $starCount;
  }
  public function inboxCount(){
    return $this->contactRepositories->inboxCount();
  }
  public function readedCount(){
    return $this->contactRepositories->readedCount();
  }
  public function replayCount(){
    return $this->contactRepositories->replayCount();
  }
  public function trashCount(){
    return $this->contactRepositories->trashCount();
  }

}
