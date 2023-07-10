<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('frontend.product.index',compact('products'));
    }

    public function cart()
    {
        $products = Product::all();
        return view('frontend.product.cart',compact('products'));
    }

    public function wishlist($product_id)
    {
        $products = Product::all();
    }

    public function confirmation()
    {
        return view('frontend.product.confirmation');
    }

    public function checkout()
    {
        return view('frontend.product.checkout');
    }

    public function getProductCategory($id)
    {
        $product = Product::find($id);
        $getImages = ProductImage::where('product_id', $id)->get();

        $productArr = [];
        $products = Product::get();
        foreach($products as $item){
            $productArr['id'][] = $item->id;
            $productArr['category_id'][] = $item->category_id;
        }
        $result = array_unique($productArr['category_id']);
        $newArr = [];
        foreach($productArr['id'] as $key => $value){
            foreach($result as $k => $val){
                if($key == $k){
                    $newArr[] = $value;
                }
            }
        }
        $productCategoryList = Product::whereIn('id', $newArr)->get();

        return view('frontend.product.product-category', compact(['getImages', 'product', 'productCategoryList']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
