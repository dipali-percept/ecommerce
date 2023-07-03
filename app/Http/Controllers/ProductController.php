<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
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

    public function getSubCategory(Request $request)
    {
        $subCategory = SubCategory::where('category_id', $request->category_id)->get(['name', 'id']);
        return response()->json($subCategory);
    }

    public function deleteImage($product,$image)
    {
        $productImage = ProductImage::where('id', $image)->first();
        $path = public_path('images\product').'\\'.$productImage->images;


        if(File::exists($path)){
            File::delete($path);
        }
        $productImage->delete();

        return redirect()->route('products.edit', $product);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('products.create', compact(['categories', 'sub_categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'images' => 'required',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();

        if ($request->hasFile('images')) {
            foreach($request->images as $item){

                $productImage = new ProductImage();

                $imageName = uniqid().'_'.time().'.'.$item->getClientOriginalExtension();
                $destination = public_path('images/product');
                $item->move($destination, $imageName);

                $productImage->images = $imageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }

        return redirect()->route('products.index')->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $getImage = ProductImage::where('product_id', $product->id)->get();
        return view('products.show',compact(['product','getImage']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        $getImage = ProductImage::where('product_id', $product->id)->get();
        return view('products.edit',compact(['product', 'categories', 'sub_categories','getImage']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $input = $request->all();
        $product->update($input);
        // if ($image = $request->file('image')) {
        //     $path = public_path('images').'\\'.$product->image;
        //     if(File::exists($path)){
        //         File::delete($path);
        //     }
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $destination = public_path('images');
        //     $image->move($destination, $imageName);
        //     $input['image'] = $imageName;
        // }


        if ($request->hasFile('images')) {
            foreach($request->images as $item){

                $productImage = new ProductImage();

                $imageName = uniqid().'_'.time().'.'.$item->getClientOriginalExtension();
                $destination = public_path('images/product');
                $item->move($destination, $imageName);

                $productImage->images = $imageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }


        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();

        foreach($productImages as $item){

            $path = public_path('images/product').'\\'.$item->images;
            if(File::exists($path)){
                File::delete($path);
            }
            $item->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
