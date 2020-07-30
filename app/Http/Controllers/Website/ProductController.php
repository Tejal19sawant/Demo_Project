<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\category;
use App\product;
use App\product_image;

class ProductController extends Controller
{
    public function products()
    {
        $category = category::with('categories')->where('parent_id','0')->get();
        $product_detl = product::with('productimage')->get();
        //print_r($product_detl);
       
        // exit();
        return view('website/products',compact('category','product_detl'));
    }

    public function product_details($id=null)
    {
        $prod_detls = product::where(['id'=>$id])->first();
        //print_r($prod_detls); exit();
        $product_imgdetl = product::with('productimage')->where(['id'=>$id])->get();
        //print_r($product_imgdetl);exit();
        return view('website/product_details')->with(compact('prod_detls','product_imgdetl'));
    }
}
