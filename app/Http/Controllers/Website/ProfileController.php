<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function showProfile(){
           $new_orders_count=auth('web')->user()
           ->orders()
           ->where('status','completed')->count();
           $deliverd_orders_count=auth('web')->user()
           ->orders()
           ->where('status','delivered')->count();
               $user=auth('web')->user()->load(['country','governrate','city']);
        return view('website.profile.profile',[
            'user'=>$user,
            'new_orders_count'=>$new_orders_count,
            'deliverd_orders_count'=>$deliverd_orders_count
        ]);
    }
}
