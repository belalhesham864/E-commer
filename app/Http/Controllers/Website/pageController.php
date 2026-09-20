<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Http\Request;

class pageController extends Controller
{
    public function index($slug)
    {
        $page = page::where('slug', $slug)->firstOrFail();
       return view('website.page', compact('page'));

    }
}
