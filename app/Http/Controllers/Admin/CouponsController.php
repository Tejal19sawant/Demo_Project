<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Coupons;

class CouponsController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $Coupons = Coupons::where('category_name', 'LIKE', "%$keyword%")
                ->orWhere('category_description', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $Coupons = Coupons::latest()->paginate($perPage);
        }
        return view('admin.coupon.index',compact('Coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'coupon_code' => 'required|min:4|max:255',
                'amount' => 'required|min:1|regex:/^[0-9]*$/|max:255',
                'expiry_date' => 'required',
            ]
        );
        //exit();
        $requestData = $request->all();
        //print_r($requestData); 

        Coupons::create($requestData);

        return redirect('/admin/coupon')->with('flash_message','Coupon added!');
    }

    public function show($id=null)
    {
        $coupon= Coupons::findOrFail($id);
        //print_r($coupon); exit();
        return view('admin.coupon.show', compact('coupon'));

    }

    public function edit($id=null)
    {
        $coupon= Coupons::findOrFail($id);
        //print_r($coupon);

        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request,$id=null)
    {
        $requestData = $request->all();
        
        $coupon = Coupons::findOrFail($id);
        $coupon->update($requestData);

        return redirect('admin/coupon')->with('flash_message', 'Coupon updated!');
    }

    public function delete($id=null)
    {
        Coupons::destroy($id);
        return redirect('/admin/coupon')->with('flash_message','Coupon deleted!');

    }
}
