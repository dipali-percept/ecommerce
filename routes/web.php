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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('admin.dashboard');
});

Route::get('/admin_profile', function () {
    return view('admin.profile');
});


// ADMIN ROUTES
Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth', 'admin', 'verified']
    ], function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class)->middleware('admin');
        Route::resource('products', ProductController::class);
        Route::post('/products/getSubCategory', [ProductController::class, 'getSubCategory'])->name('products.getSubCategory');
        Route::get('/products/deleteImage/{product_id}/{image_id}', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
        Route::resource('categories', CategoryController::class);
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


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('users', UserController::class)->withoutMiddleware('admin');
// Route::resource('posts', PostController::class)->middleware(['auth', 'user']);

require __DIR__.'/auth.php';
