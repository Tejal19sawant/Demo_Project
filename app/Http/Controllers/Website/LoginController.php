<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
use App\DeliveryAddress;

class LoginController extends Controller
{
    public function userLogin()
    {
        return view('website/users/login_register'); 
    }

    public function register(Request $request)
    {
        $data = $request->all();
       // print_r($data);exit();

        $usercount = User::where('email',$data['email'])->count();
        //print_r($usercount);exit();
        if($usercount > 0)
        {
            return redirect()->back()->with('flash_message_error','Email is already exist');
        }
        else{
            // echo 'yes';

            //adding user in table
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            if(Auth::guard('website')->attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'0']))
            { 
                //echo 'yess';exit();
                 Session::put('frontSession',$data['email']);
                 //echo Session::get('frontSession');
               // exit();
                return redirect('/cart');
            }
        }
    }

    public function logout()
    { 
         Session::forget('frontSession');
        // Auth::logout();
        auth('website')->logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
      
        $data = $request->all();
        // print_r($data);

        if(Auth::guard('website')->attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'0']))
        { 
           
            Session::put('frontSession',$data['email']);
            //echo Session::get('frontSession');
            return redirect('/cart');  
        }
        else{
           
            return redirect()->back()->with('flash_message_error','Invalid Username and Password !');
        }

        // exit();
    }

    public function account(Request $request)
    {
        return view('website/users/account');
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $old_pwd = User::where('id',Auth::user()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password))
            {
                $new_pwd = bcrypt($data['new_password']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message','Your Password is changed Now !');
            }
            else{
                return redirect()->back()->with('flash_message_error','Old Password is Incorrect !');
            }
        }
        return view('website/users/change_password');
    }

    public function changeAddress(Request $request)
    {  
        $user_id =Auth::user()->id;
        //echo $user_id; exit();
        $userDetails = User::find($user_id);
        //print_r($userDetails);exit();
        
        if($request->isMethod('post')){
            $data = $request->all();
            //return $data;
            $user = User::find($user_id);
            //print_r($user); exit();
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();

            return redirect()->back()->with('flash_message','Account Details has been updated');
        }
        

        $countries = Country::get();
        return view('website/users/change_address',compact('countries','userDetails'));
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::guard('website')->user()->id;
        //echo $user_id;
        $user_email =Auth::guard('website')->user()->email;
        //echo $user_email;
        $shippingDetails= DeliveryAddress::where('user_id',$user_id)->first();
        //print_r($shippingDetails); exit();
        $userDetails = User::find($user_id);
        $country = Country::get();
        //$shippingDetails =  array();
        //check if shipping address exits
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        
       
        if($shippingCount > 0)
        {
            $shippingCount1 = DeliveryAddress::where('user_id',$user_id)->first();
            //print_r($shippingCount1);exit();
        }

        //update cart table with email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
        if($request->isMethod('post')){
            $data  = $request->all();
            // print_r($data);

            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],
            'city'=>$data['billing_city'],'state'=>$data['billing_state'],'pincode'=>$data['billing_pincode'],
            'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);

            if($shippingCount > 0)
            {
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],
            'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'pincode'=>$data['shipping_pincode'],
            'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile']]);
            }
            else{
                //New Shipping Address
                $shipping = new DeliveryAddress;
               
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
                

            }
            //echo 'redirect'; exit();
        }
        return view('website/products/checkout',compact('userDetails','country','shippingDetails'));
    }
}
