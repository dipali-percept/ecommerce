<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function($view)
        {
            $userCount = User::count();
            $productCount = Product::count();
            $bannerList = Banner::where('is_active', 1)->get();
            $productList = Product::get();

            $productArr = [];
            $product = Product::get();
            foreach($product as $item){
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

            $admin = User::first();

            $view
            ->with('userCount', $userCount)
            ->with('productCount', $productCount)
            ->with('bannerList', $bannerList)
            ->with('productCategoryList', $productCategoryList)
            ->with('productList', $productList)
            ->with('admin_contact', $admin->number);
        });

    }
}
