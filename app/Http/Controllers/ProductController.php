<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(10);
        return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        $input = $request->all();

        $image = $request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destination = public_path('images');
        $image->move($destination, $imageName);

        $input['image'] = $imageName;

        Product::create($input);

        return redirect()->route('products.index')->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit',compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'category_id' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $path = public_path('images').'\\'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('images');
            $image->move($destination, $imageName);
            $input['image'] = $imageName;
        }

        $product->update($input);

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $path = public_path('images').'\\'.$product->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
