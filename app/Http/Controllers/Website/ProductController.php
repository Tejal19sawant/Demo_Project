<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Session;

use App\category;
use App\product;
use App\product_image;
use App\productattributeassoc;
use App\Cart;
use App\Coupons;
use Session;
use Auth;



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

    public function addtoCart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('Coupon_code');
        
        
        
        $data = $request->all();
        //print_r($data);exit();
        $array = explode('-', $data['size']);
        //print_r($array);exit();
        if(empty($data['user_email'])){
            $data['user_email']='';
        }
        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = Str::random(40); 
            Session::put('session_id',$session_id);
        }
       
        $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
        'product_colour'=>$data['product_colour'],
        'price'=>$data['product_price'],
        'size'=>$array[1],
        'session_id'=>$session_id
        ])->count();

        
        
        if($countProducts>0)
        {
            return redirect()->back()->with('flash_message_error','Product already exist in cart');
        }
        else{
            
            
            DB::table('cart')->insert(['product_id'=>$data['product_id'],
            'product_name'=>$data['product_name'],
            'product_code'=>$data['product_code'],
            'product_colour'=>$data['product_colour'],
            'price'=>$data['product_price'],
            'size'=>$array[1],
            'quantity'=>$data['quantity'],
            'user_email'=>$data['user_email'],
            'session_id'=>$session_id
            ]);
        }

        //echo Auth::guard('website')->user()->name;   
       // exit();
        if(!empty(Auth::guard('website')->user()->name))
        {
            return redirect('/cart')->with('flash_message','Product has been added in cart');
        }
        else{
            return redirect('/login-register')->with('flash_message_error','Login !!');
        }
    }

    public function Cart(Request $request)
    {
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        
        foreach($userCart as $key=>$products)
        {
           //echo $products->product_id;
           $productDetails = product::where(['id'=>$products->product_id])->first();
           //print_r($productDetails); exit();
            $userCart[$key]->image = $productDetails->image;
        }
        //print_r($userCart);
        return view('website/products/cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id=null)
    {
        Session::forget('CouponAmount');
        Session::forget('Coupon_code');
        // echo $id;
        Cart::destroy($id);
        return redirect('/cart')->with('flash_message_error','Product has been deleted from cart');
    }

    public function updateCartQuantity($id=null,$quantity=null)
    {
        Session::forget('CouponAmount');
        Session::forget('Coupon_code');
        DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
        return redirect('/cart')->with('flash_message','Product quantity has been updated succesfully.');
    }

    public function applyCoupon(Request $request)
    {   Session::forget('CouponAmount');
        Session::forget('Coupon_code');
        $data = $request->all();
        // print_r($data);
        $couponCount = Coupons::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0)
        {
            return redirect()->back()->with('flash_message_error','Coupon code does not exists');
        }
        else{
            // echo 'success';
            $couponDetails = Coupons::where('coupon_code',$data['coupon_code'])->first();

            //Coupon Code status
            if($couponDetails->status==0)
            {
                return redirect()->back()->with('flash_message_error','Coupon code is not active');
            }

            //check coupon expiry date
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message_error','Coupon code is Expired');
            }

            //Coupon is ready for discount
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            $total_amount = 0;

            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            //check if coupon amount is fixed or percentage
            if($couponDetails->status=="Fixed")
            {
                $couponAmount = $couponDetails->amount;
            }
            else{
                $couponAmount = $total_amount *($couponDetails->amount/100);
            }

            //Add Coupon code in session
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);
            return redirect()->back()->with('flash_message','Coupon Code is succesfully Applied. You are Availing Discount');

        }
    }

}
