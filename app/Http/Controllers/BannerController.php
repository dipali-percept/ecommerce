<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::latest()->paginate(10);
        return view('banner.index',compact('banner'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            'end_date' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            // 'is_active' => 'required',
        ]);

        $input = $request->all();

        $image = $request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destination = public_path('banner');
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
            'start_date' => 'required',
            'end_date' => 'required',
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            // 'is_active' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $path = public_path('banner').'\\'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('banner');
            $image->move($destination, $imageName);
            $input['image'] = $imageName;
        }

        $banner->update($input);

        return redirect()->route('banner.index')->with('success','Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banner.index')->with('success','Banner deleted successfully');
    }
}
