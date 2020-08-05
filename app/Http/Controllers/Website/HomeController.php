<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\category;
use App\product;
use App\banner;

class HomeController extends Controller
{
    //
    public function index()
    {
        $category = category::with('product')->where('status','1')->get();
        //print_r($category); exit();

        $banners = banner::orderby('sortorder','asc')->get();
        //print_r($banners);

        

        return view('website/home',compact('category','banners'));
    }

    
}
