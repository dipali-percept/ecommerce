<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\frontend\PasswordResetController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;
use App\Http\Controllers\frontend\RegisterController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/master', function () {
//     return view('admin.dashboard');
// });

Route::get('/admin_profile', function () {
    return view('admin.profile');
});

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/product', function () {
    return view('frontend.product.index');
})->name('product');

// USER ROUTES

Route::get('/user/login', [LoginController::class, 'create'])->name('user.login');
Route::get('/user/register', [RegisterController::class, 'create'])->name('user.register');
Route::get('/user/forgot-password', [PasswordResetController::class, 'create'])->name('user.forgot-password');

Route::resource('home', HomeController::class);
Route::resource('product', FrontendProductController::class);
Route::get('/product/{id}/category', [FrontendProductController::class, 'getProductCategory'])->name('product.category');
Route::get('/product-cart', [FrontendProductController::class, 'cart'])->name('product.cart');
Route::get('/product-wishlist', [FrontendProductController::class, 'wishlist'])->name('product.wishlist');
Route::get('/product-confirmation', [FrontendProductController::class, 'confirmation'])->name('product.confirmation');
Route::get('/product-checkout', [FrontendProductController::class, 'checkout'])->name('product.checkout');

Route::get('/user-interface', [HomeController::class, 'interface'])->name('user.interface');
Route::get('/user-address', [HomeController::class, 'getAddress'])->name('user.address');
Route::get('/user-profile', [HomeController::class, 'profile'])->name('user.profile');

Route::resource('order', FrontendOrderController::class);

// ADMIN ROUTES
Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth', 'admin', 'verified']
    ], function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class)->middleware('admin');
        Route::resource('products', ProductController::class);
        Route::post('/products/getSubCategory', [ProductController::class, 'getSubCategory'])->name('products.getSubCategory');
        Route::get('/products/deleteImage/{product_id}/{image_id}', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
        Route::resource('categories', CategoryController::class);
        Route::get('/categories/{id}/geProducts', [CategoryController::class, 'getProducts'])->name('categories.geProducts');
        Route::resource('posts', PostController::class);
        Route::resource('country', CountryController::class);
        Route::resource('sub_category', SubCategoryController::class);
        Route::resource('currency', CurrencyController::class);
        Route::resource('banner', BannerController::class);
        Route::get('/banner/{id}/status', [BannerController::class, 'changeStatus'])->name('banner.changeStatus');
        Route::get('/image-gallery', [ImageGalleryController::class, 'index']);
        Route::post('/image-gallery', [ImageGalleryController::class, 'upload']);
        Route::delete('image-gallery/{id}', [ImageGalleryController::class, 'destroy']);
        Route::resource('orders', OrderController::class);
        Route::resource('order_status', OrderStatusController::class);

        Route::resource('posts', PostController::class);

    }
)->name('admin.');


// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('users', UserController::class)->withoutMiddleware('admin');
// Route::resource('posts', PostController::class)->middleware(['auth', 'user']);

require __DIR__.'/auth.php';
