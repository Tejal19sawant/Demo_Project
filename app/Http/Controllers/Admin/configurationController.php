<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\configuration;
use Illuminate\Http\Request;
use App\Page;



class configurationController extends Controller
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
            $configuration = configuration::where('constant_name', 'LIKE', "%$keyword%")
                ->orWhere('constant_value', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $configuration = configuration::latest()->paginate($perPage);
        }
       
        return view('admin.configuration.index', compact('configuration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.configuration.create');
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
        $validator = $request->validate(
            [
                'constant_name' => 'required|min:4|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/|max:255',
                'constant_value' => 'required|min:4|max:255',
            ]
        );
       
        $requestData = $request->all();
        //print_r($requestData);
       
        //exit();        
        configuration::create($requestData);

        return redirect('admin/configuration')->with('flash_message', 'configuration added!')->withInput();
       
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
        $configuration = configuration::findOrFail($id);

        return view('admin.configuration.show', compact('configuration'));
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
        $configuration = configuration::findOrFail($id);

        return view('admin.configuration.edit', compact('configuration'));
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
        
        $configuration = configuration::findOrFail($id);
        $configuration->update($requestData);

        return redirect('admin/configuration')->with('flash_message', 'configuration updated!');
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
        configuration::destroy($id);

        return redirect('admin/configuration')->with('flash_message', 'configuration deleted!');
    }
}
