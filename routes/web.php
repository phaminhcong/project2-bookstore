<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Review\ReviewController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Customer\Auth\CustomerCilentController;
use App\Http\Controllers\Customer\Auth\LoginCustomerController;
use App\Http\Controllers\Customer\Auth\LogoutCustomerController;
use App\Http\Controllers\Customer\Auth\RegisterCustomerController;
use App\Http\Controllers\Customer\Cart\CartController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['saveUrlBeforeLogin'])->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('/cilent/add-to-card/{id}', 'addToCart')->name('cart.add');
        Route::get('/cilent/cart', 'showCart')->name('cart.show');
        Route::post('/cilent/update-card', 'updateCart')->name('cart.update');
        Route::get('/cilent/remove-from-cart/{id}', 'removeFromCart')->name('cart.remove');
        Route::get('/cilent/cart-checkout', 'showCheckoutCart')->name('cart.checkout');
        Route::post('/cilent/cart-order', 'cartOrder')->name('cart.cartOrder');
    });
        Route::get('/client/product-detail/{id}', [ProductController::class,'product_detail'])->name('product.product-detail');
        Route::get('/cilent/product-category/{id}', [ProductController::class,"showProductsByCategory"]);
       
});
Route::controller(CartController::class)->group(function () {
    Route::post('/cilent/cart-order', 'cartOrder')->name('cart.cartOrder');
});
Route::controller(ReviewController::class)->group(function () {
    Route::post('/cilent/post_review', 'post_review')->name('review.post');
});
Route::get('/cilent/history', function () {
    return view('customer.cart.order_history');
});
Route::get('/product-quick-view/{id}',[ProductController::class,"ProductQuickView"]);
Route::get('/cilent1',[ProductController::class,"allTest"]);
Route::get('/cilent2',[ProductController::class,"allTest1"]);
Route::get('/cilent3',[ProductController::class,"topSellingProductsShow"]);
Route::get('/cilent4',[ProductController::class,"productsOnSale()"]);
Route::get('/cilent  ',[ProductController::class,"combined"]);
Route::get('/cilent/information-customer/{id}',[OrderController::class,"getOrdersByCustomer"])->name('customer.information');
Route::get('/cilent/order-history/{id}',[OrderController::class,"orderHistory"])->name('cart.order-history');
Route::post('/cilent/order-cancel/{id}',[OrderController::class,"updateOrder"])->name('order.cancel');
// Route::get('/list-customer', function () {
//     return view('admin.customers.list_customer');
// });
// Route::get('/add-customer', function () {
//     return view('admin.customers.add_customer');
// });
Route::controller(RegisterCustomerController::class)->group(function () {
    Route::get('/cilent/register', 'show')->name('registerCustomer.show');
    Route::post('/cilent/register', 'store')->name('registerCustomer.store');
});


Route::controller(LoginCustomerController::class)->group(function () {
    Route::get('/cilent/login', 'show')->name('customer.login') -> middleware('checkLoginCustomer');
    Route::post('/cilent/login', 'authenticate');
});
Route::controller(CustomerCilentController::class)->group(function () {
    Route::post('/cilent/update-customer/{id}', 'updateCustomer')->name('customer.update');
});
Route::any('/cilent/logout', [LogoutCustomerController::class,"logout"])->name('customer.logout');
// admin
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'show')->name('admin.login')->middleware('checkLogout');
    Route::post('/login', 'authenticate')->name('admin.login');
});
Route::middleware('checkLogin')->group(function () {
    Route::get('/admin/information', function () {
        return view('admin.auth.information');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/list-user', 'all')->name('user.all');
        Route::get('/admin/add-user', 'addUser');
        Route::get('/admin/soft-delete-user/{id}', 'softDeletedUser')->name('softDeletedUser');
        Route::post('/admin/information-update/{id}', 'updateAdmin')->name('user.update');
        Route::get('/admin/user/{id}/edit', "editUser")->name('user.edit');
        Route::post('/admin/user/{id}', "updateInformationUser")->name('user.update-user');
        
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'show')->name('register.show');
        Route::post('/register', 'store')->name('register.store');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/admin/list_customer', 'all')->name('customer.all');
        Route::get('/admin/search-customer',"search")->name('customer.search');
        Route::get('/admin/deleted-customer/{id}', 'softDeletedCustomer')->name('softDeletedCustomer'); 
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin', 'lowStock')->name('admin');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/list-category', 'all')->name('category.all');
        Route::get('/admin/category/{id}', 'softDeleted')->name('softDeleted');
        Route::get('/admin/add-category',"create")->name('category.create');
        Route::post('/admin/add-category',"store")->name('category.store');
        Route::get('/admin/category/{id}/edit', "edit")->name('category.edit');
        Route::post('/admin/category/{id}', "update")->name('category.update');
        Route::get('/admin/search-category',"search")->name('category.search');
    });
    Route::controller(ProductController::class)->group(function () {
    Route::get('/admin/list-product', "all") -> name('product.all');
    Route::get( '/admin/delete-product/{id}', "softDeleteProduct") ->name('softDeleteProduct');
    Route::get('/admin/add-product',"create")->name('product.create');
    Route::post('/admin/add-product', "store")->name('product.store');
    Route::get('/admin/edit-product/{id}',"edit")->name('product.edit');
    Route::post('/admin/update-product/{id}',"update")->name('product.update');
    Route::get('/admin/search-product',"search")->name('product.search');
    Route::get('/admin/low-stock-products',"getLowStockProducts")->name('product.lowStock');
    Route::get('/admin/top-selling-products',"topSellingProducts")->name('product.top-selling');
    Route::get('/admin/top-rated-products',"showTopRatedProducts")->name('product.top-rated');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/list-order', "all") -> name('order.all');
        Route::get('/admin/list-order/{id}', 'softDeleted')->name('order.softDeleted');
        Route::post('/admin/update-status/{id}', 'updateStatus')->name('order.updateStatus');
        Route::get('/admin/list-order-detail/{order_id}','showOrderDetail')->name('orderDetail.show');
        Route::get('/admin/revenue','index')->name('thong-ke.index');
        });
   
});
Route::any('/admin/logout', [LogoutController::class, "logout"])->name('admin.logout');
 