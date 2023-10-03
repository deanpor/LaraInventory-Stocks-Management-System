<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StockController;
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

//Route::get('/', function () {
//    return view('products.products_table');
//});


Route::group(['middleware'=>'guest'], function(){

    //User Sign Up
    Route::get('register', [RegisterController::class, 'create'])->name('user.sign_up');
    Route::post('register', [RegisterController::class, 'store']);

    //User Sign In
    Route::get('/', [SessionsController::class, 'create'])->name('login');
    Route::post('login', [SessionsController::class, 'store']);
});


Route::group(['middleware' => 'auth'],function(){
    //User Sign Out
    Route::post('logout',[SessionsController::class, 'destroy']);
    Route::get('/user/qrcode', [SessionsController::class, 'generateQRCode'])->name('qr-code.generate');

    //products
    Route::get('products/search', [ProductController::class, 'index'])->name('product.search');
    Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('products/create', [ProductController::class, 'store']);
    Route::get('products/{product:id}',[ProductController::class, 'show']);
    Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('product.update');
    Route::post('products/edit/{id}', [ProductController::class, 'update']);
    Route::get('products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('products/delete/{id}', [ProductController::class, 'destroy']);
    Route::get('products/deleted_product/index', [ProductController::class, 'deleted_product_index'])->name('product.deleted');
    Route::get('products/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::post('products/restore/{id}', [ProductController::class, 'recover']);


    //stocks
    Route::get('stocks/search', [StockController::class, 'index'])->name('stock.search');
    Route::get('stocks/create', [StockController::class, 'create'])->name('stock.create');
    Route::post('stocks/create', [StockController::class, 'store']);
    Route::get('stocks/edit/{id}', [StockController::class, 'edit'])->name('stock.update');
    Route::post('stocks/edit/{id}', [StockController::class, 'update']);
    Route::get('stocks/delete/{id}', [StockController::class,'delete'])->name('stock.delete');
    Route::post('stocks/delete/{id}', [StockController::class, 'destroy']);
    Route::get('stock/{id}', [StockController::class, 'show']);
    Route::get('stock/in_stock/index', [StockController::class, 'in_stock_index'])->name('stock.in_stock');
    Route::get('stocks/sell_stock/{id}', [StockController::class, 'sell_stock'])->name('stock.sell_stock');
    Route::post('stocks/sell_stock/{id}', [StockController::class, 'stock_sold']);
    Route::get('stocks/deleted_stock/index', [StockController::class, 'deleted_stock_index'])->name('stock.deleted');
    Route::get('stocks/restore/{id}', [StockController::class, 'restore'])->name('stock.restore');
    Route::post('stocks/restore/{id}', [StockController::class, 'recover']);
    Route::post('stocks/multi_delete', [StockController::class, 'multi_delete'])->name('stock.multi.delete');

    //customers
    Route::get('customers/search',[CustomerController::class, 'index'])->name('customer.search');
    Route::get('customers/create',[CustomerController::class, 'create'])->name('customer.create');
    Route::post('customers/create',[CustomerController::class,'store']);
    Route::get('customers/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('customers/edit/{id}', [CustomerController::class, 'edit'])->name('customer.update');
    Route::post('customers/edit/{id}', [CustomerController::class, 'update']);
    Route::get('customers/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::post('customers/delete/{id}', [CustomerController::class, 'destroy']);
    Route::get('customers/deleted_customer/index',[CustomerController::class, 'deleted_customer_index'])->name('customer.deleted');
    Route::get('customers/restore/{id}', [CustomerController::class,'restore'])->name('customer.restore');
    Route::post('customers/restore/{id}', [CustomerController::class, 'recover']);

    //users
    Route::get('users/edit/{id}', [SessionsController::class, 'edit'])->name('user.update');
    Route::post('users/edit/{id}', [SessionsController::class, 'update']);

    Route::get('users/edit/password/{id}', [SessionsController::class, 'edit_password'])->name('user.password.update');
    Route::post('users/edit/password/{id}', [SessionsController::class, 'update_password']);


});


