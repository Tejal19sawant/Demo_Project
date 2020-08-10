<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kodeine\Acl\Models\Eloquent\Permission;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\User;
use Auth;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {  
        /*********************This will insert data in permissions table*/
        // permission::insert([
        //     [   'name'=>'edit',
        //         'slug'=>'edit',
        //         'description'=>'edit data'
        //     ]
        // ]);
        /*********************This will insert data in permissions table*/

        /****it will find the role by id and will give the permissions to it*****/
        //$role = Role::find(1);
        //$permission = Permission::find(1);
        
        //$role->syncPermissions([1,2]); //$permission
        //$role->assignPermission('view'); 
        //$role->revokeAllPermissions();
        /****it will find the role by id and will give the permissions to it*****/

        /****it will assign permission and  to the user*****/
        //auth()->user()->addPermission('view');
        //auth()->user()->assignRole('superadmin');
        /****it will assign permission and  to the user*****/

        //return auth()->user()->getPermissions();
        
        // echo 'hii'; exit();
        $user = Auth::user();
        //print_r($user); exit();
        if($user['admin']=='1')
        {
            //echo 'yes';
            return view('/admin/dashboard'); //after login by default this page is showing
        }
        else{
            //echo 'no';
            return redirect('/')->with('flash_message_error','Invalid Username or Password'); //after login by default this page is showing
        }
        
        
    }

    
    
}
