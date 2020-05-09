<?php

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

// Start Authentication Routing
Route::get('/login', 'AuthController@login');
Route::get('/register', 'AuthController@register');
Route::post('/register/post', 'AuthController@register_post');
Route::post('/cek-login', 'AuthController@cek_login');
//Admin Logout
Route::get('a/logout', 'AuthController@logout');
// Customer Logout
Route::get('/logout', 'AuthController@logout');
// End Authentication Routing

// Start User Routing
// Home
Route::get('/', 'HomeController@index');
// profile
Route::get('/profile', 'AuthController@profile');
Route::post('/profile/update', 'AuthController@update_profile');
// Product
Route::get('/product', 'ProductController@index');
Route::get('/product/detail/{id}', 'ProductController@detail');
// Transaction
Route::get('/shop/cart', 'ShoppingController@cart');
Route::get('/shop/min', 'ShoppingController@min_jumlah');
Route::get('/shop/plus', 'ShoppingController@plus_jumlah');
Route::get('/shop/cancel/{id}', 'ShoppingController@cancel');
Route::get('/shop/delete', 'ShoppingController@delete_product');
Route::get('/shop/checkout', 'ShoppingController@checkout');
Route::post('/shop/checkout/process', 'ShoppingController@done');
Route::get('/shop/history/unpaid/{id}', 'ShoppingController@unpaid');
Route::get('/shop/history/paid/process', 'ShoppingController@paid_process');
Route::get('/shop/history/paid/{id}', 'ShoppingController@paid');
// Contact
Route::get('/contact', 'ContactController@index');
Route::post('/contact/post', 'ContactController@success');
// End User Routing

// Start Admin Routing
// Home
Route::get('a/home', 'admin\HomeController@index');
//ChartPendapatan
Route::get('a/home', 'admin\HomeController@index');
Route::get('a/home/laporan-pendapatan','admin\HomeController@getLaporanPendapatan');
// Category
Route::get('a/category', 'admin\CategoryController@index');
Route::get('/a/category/add', 'admin\CategoryController@add');
Route::post('/a/category/save', 'admin\CategoryController@save');
Route::get('/a/category/edit/{id}', 'admin\CategoryController@edit');
Route::post('/a/category/update', 'admin\CategoryController@update');
Route::get('/a/category/delete/{id}', 'admin\CategoryController@delete');
// Product
Route::get('/a/product', 'admin\ProductController@index');
Route::get('/a/product/detail/{id}', 'admin\ProductController@detail');
Route::get('/a/product/preview/add/{id}', 'admin\ProductController@add_preview');
Route::post('/a/product/preview/save', 'admin\ProductController@save_preview');
Route::get('/a/product/add', 'admin\ProductController@add');
Route::post('/a/product/save', 'admin\ProductController@save');
Route::get('/a/product/edit/{id}', 'admin\ProductController@edit');
Route::post('/a/product/update', 'admin\ProductController@update');
Route::get('/a/product/delete/{id}', 'admin\ProductController@delete');
// Supplier
Route::get('a/supplier', 'admin\SupplierController@index');
Route::get('/a/supplier/detail/{id}', 'admin\SupplierController@detail');
Route::get('/a/supplier/add', 'admin\SupplierController@add');
Route::post('/a/supplier/save', 'admin\SupplierController@save');
Route::get('/a/supplier/edit/{id}', 'admin\SupplierController@edit');
Route::post('/a/supplier/update', 'admin\SupplierController@update');
Route::get('/a/supplier/delete/{id}', 'admin\SupplierController@delete');
//Inventory
Route::get('a/inventory', 'admin\InventoryController@index');
Route::get('a/inventory/cart', 'admin\InventoryController@add_facture');
Route::get('a/inventory/min', 'admin\InventoryController@min_jumlah');
Route::get('a/inventory/plus', 'admin\InventoryController@plus_jumlah');
Route::post('a/inventory/checkout', 'admin\InventoryController@checkout');
Route::get('a/inventory/cancel/{id}', 'admin\InventoryController@cancel');
Route::get('a/inventory/detail/{id}', 'admin\InventoryController@detail');
Route::get('a/inventory/download/{id}', 'admin\InventoryController@download');
Route::get('a/inventory/print/{id}', 'admin\InventoryController@print');
// Kontak
Route::get('a/contact', 'admin\ContactController@index');
Route::get('/a/contact/detail/{id}', 'admin\ContactController@detail');
Route::get('/a/contact/delete/{id}', 'admin\ContactController@delete');
//List User
Route::get('a/list-user', 'admin\ListUserController@index');
// End Admin Routing
