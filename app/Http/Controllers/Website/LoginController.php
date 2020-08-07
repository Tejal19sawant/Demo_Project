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

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
            {
                Session::put('frontSession',$data['email']);
                return redirect('/cart');
            }
        }
    }

    public function logout()
    {
        Session::forget('frontSession');
        Auth::logout();
        return redirect('/index');
    }

    public function login(Request $request)
    {
        
        $data = $request->all();
        // print_r($data);

        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
        {
            Session::put('frontSession',$data['email']);
            return redirect('/cart');
        }
        else{
            return redirect()->back()->with('flash_message_error','Invalid Username and Password !');
        }
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
}
