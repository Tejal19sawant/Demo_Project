<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\category;
use App\product;
use App\product_image;

class HomeController extends Controller
{
    //
    public function index()
    {
        $category = category::where('status','1')->get();
        //print_r($category);
        return view('website/home',compact('category'));
    }

    
}
