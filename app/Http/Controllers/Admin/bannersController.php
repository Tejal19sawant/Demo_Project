<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\banner;
use Illuminate\Http\Request;
use App\Page;

class bannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $banners = banner::where('name', 'LIKE', "%$keyword%")
                ->orWhere('textstyle', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->orWhere('sortorder', 'LIKE', "%$keyword%")
                ->orWhere('bannerimage', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $banners = banner::latest()->paginate($perPage);
        }

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
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
        
        $request->validate(
            [
                'name' => 'required|min:4|regex:/^([a-zA-Z. -]+\s)*[a-zA-Z. -]+$/|max:255',
                'textstyle' => 'required|min:4|max:255',
                'sortorder' => 'required|min:4|max:255',
                'bannerimage' => 'required',
                //'category_description' => 'required|min:8|max:255',
            ]
        );
        //exit();

        $requestData = $request->all();
                if ($request->hasFile('bannerimage')) {
            $requestData['bannerimage'] = $request->file('bannerimage')
                ->store('uploads', 'public');
        }

        banner::create($requestData);

        return redirect('admin/banners')->with('flash_message', 'banner added!');
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
        $banner = banner::findOrFail($id);

        return view('admin.banners.show', compact('banner'));
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
        $banner = banner::findOrFail($id);

        return view('admin.banners.edit', compact('banner'));
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
                if ($request->hasFile('bannerimage')) {
            $requestData['bannerimage'] = $request->file('bannerimage')
                ->store('uploads', 'public');
        }

        $banner = banner::findOrFail($id);
        $banner->update($requestData);

        return redirect('admin/banners')->with('flash_message', 'banner updated!');
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
        banner::destroy($id);

        return redirect('admin/banners')->with('flash_message', 'banner deleted!');
    }
}
