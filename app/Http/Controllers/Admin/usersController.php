<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\user;
use Illuminate\Http\Request;
use App\Page;


use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Models\Eloquent\Role;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) { 
            $users = user::where('name', 'LIKE', "%$keyword%")
                ->orWhere('lastname', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->orWhere('confirmpassword', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = user::latest()->paginate($perPage);
        }

        $role = Role::all();
        //print_r($role);

        return view('admin.users.index', compact('users','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role = Role::all();
        //print_r($role);
        

        return view('admin.users.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        $request->validate(
            [
                'name' => 'required|min:3|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
                'lastname' => 'required|min:4|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
                'email' => 'required|min:8|regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/|max:255',
                'password' => 'required|min:8|regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/|confirmed|max:255',
                'confirmpassword' => 'required|min:8|regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/|max:255',
            ]
        );
        //exit();

        $admin = new user;
        $admin->name = $request->input('name');
        $admin->lastname = $request->input('lastname');
        $admin->email = $request->input('email');
        $admin->password=bcrypt($request->input('password'));
        $admin->confirmpassword=bcrypt($request->input('confirmpassword'));
        $admin->status = $request->input('status');
        $admin->role = $request->input('role');
        $admin->created_at=date("Y-m-d H:i:s");
        $admin->save();
        //print_r($requestData); exit();

        //user::create($requestData);

        return redirect('admin/users')->with('flash_message', 'user added!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = user::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = user::findOrFail($id);
        //print_r($user); exit();
        $role = Role::all();
        //print_r($role);

        return view('admin.users.edit', compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $user = user::findOrFail($id);
        $user->update($requestData);

        return redirect('admin/users')->with('flash_message', 'user updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        user::destroy($id);

        return redirect('admin/users')->with('flash_message', 'user deleted!');
    }
}
