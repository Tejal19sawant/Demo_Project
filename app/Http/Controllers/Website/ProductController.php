<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\category;
use App\product;
use App\product_image;
use App\productattributeassoc;


class ProductController extends Controller
{
    public function products()
    {
        $category = category::with('categories')->where('parent_id','0')->get();
        $product_detl = product::get();
        //print_r($product_detl);
       
        // exit();
        return view('website/products',compact('category','product_detl'));
    }

    public function product_details($id=null)
    {
        $prod_detls = product::with('attributes')->where(['id'=>$id])->first();
        //print_r($prod_detls); exit();

        $productAltImages = product_image::where('product_id',$id)->get();
        //print_r($productAltImages);exit();
        $featuredProducts = product::where(['featured_products'=>1])->get();

        return view('website/product_details')->with(compact('prod_detls','productAltImages','featuredProducts'));
    }

    public function categories($categoty_id)
    {
        $category = category::with('categories')->where('parent_id','0')->get();
        $product_detl = product::where(['category_id'=>$categoty_id])->get();
        //print_r($product_detl);

        $product_name = product::where(['category_id'=>$categoty_id])->first();
        //print_r($product_name); exit();
        return view('website/category')->with(compact('category','product_detl','product_name'));
    }

    public function getprice(Request $request)
    {
        $data = $request->all();
        //print_r($data);
        $prodArr = explode("-",$data['idSize']);
        //print_r($prodArr);
        $proAttr = productattributeassoc::where(['product_id'=>$prodArr[0],'size'=>$prodArr[1]])->first();
        //print_r($proAttr);
        echo $proAttr->price;
    }
}
