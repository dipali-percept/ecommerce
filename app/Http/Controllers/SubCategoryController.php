<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = SubCategory::all();
        return view('sub-category.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        SubCategory::create($request->all());

        return redirect()->route('sub_category.index')->with('success','Sub Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $sub_category)
    {
        return view('sub-category.show',compact('sub_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::all();
        return view('sub-category.edit',compact(['categories','sub_category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $sub_category->update($request->all());

        return redirect()->route('sub_category.index')->with('success','Sub Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();
        return redirect()->route('sub_category.index')->with('success','Sub Category deleted successfully');
    }
}
