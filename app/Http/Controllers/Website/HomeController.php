<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\category;
use App\product;

class HomeController extends Controller
{
    //
    public function index()
    {
        $category = category::where('status','1')->get();
        //print_r($category);
        return view('website/home',compact('category'));
    }

    public function products()
    {
        $category = category::where('status','1')->get();
        $product_detls = product::with('attributes')->get();
        //print_r($product_detls);
        return view('website/products',compact('category','product_detls'));
    }
}
