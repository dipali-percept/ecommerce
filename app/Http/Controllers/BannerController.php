<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index',compact('banners'));
    }

    public function changeStatus($id)
    {
        $banner = Banner::find($id);

        if($banner->is_active == 1){
            $banner->is_active = 0;
        } else {
            $banner->is_active = 1;
        }
        $banner->touch();
        return redirect()->route('banner.index')->with('success','Banner status changed.');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date'    => 'required|after:start_date',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        $image = $request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destination = public_path('images/banner');
        $image->move($destination, $imageName);

        $input['image'] = $imageName;
        $input['is_active'] = 1;

        Banner::create($input);

        return redirect()->route('banner.index')->with('success','Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('banner.show',compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'start_date'  => 'required',
            'end_date'    => 'required|after:start_date',
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            // 'is_active' => 'required',
        ]);

        $input = $request->all();

        if ($request->file('image')) {
            $image = $input['image'];
            $path = public_path('images/banner').'\\'.$banner->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('images/banner');
            $image->move($destination, $imageName);
            $input['image'] = $imageName;
        } else {
            $input['image'] = $banner->image;
        }

        $banner->update($input);

        return redirect()->route('banner.index')->with('success','Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $path = public_path('images/banner').'\\'.$banner->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('success','Banner deleted successfully');
    }
}
