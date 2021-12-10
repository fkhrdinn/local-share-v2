<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    //Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //User
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');

    //Product
    Route::get('/product', 'ProductController@index')->name('product');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::get('/product/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::get('/product/{id}/delete', 'ProductController@destroy')->name('product.destroy');

    //Invoice
    Route::get('/invoices', 'InvoiceController@index')->name('invoices');

    Route::get('/celebrities', 'CelebrityController@index')->name('celebrities');

    //Merchant
    Route::get('/merchants', 'MerchantController@index')->name('merchants');

    //Voucher
    Route::get('/voucher', 'VoucherController@index')->name('voucher');
    Route::get('/voucher/create', 'VoucherController@create')->name('voucher.create');
    Route::get('/voucher/{voucher}/edit', 'VoucherController@edit')->name('voucher.edit');
    Route::get('/voucher/{id}/delete', 'VoucherController@destroy')->name('voucher.destroy');

    //FAQ
    Route::get('/faq', 'FaqController@index')->name('faq');
    Route::get('/faq/create', 'FaqController@create')->name('faq.create');
    Route::get('/faq/{faq}/edit', 'FaqController@edit')->name('faq.edit');
    Route::get('/faq/{id}/delete', 'FaqController@destroy')->name('faq.destroy');

    //Broadcast
    Route::get('/broadcasts', 'BroadcastController@index')->name('broadcasts');
    Route::get('/broadcasts/create', 'BroadcastController@create')->name('broadcasts.create');
    Route::get('/broadcasts/{id}/delete', 'BroadcastController@destroy')->name('broadcasts.destroy');

    //Settings
    Route::get('/settings', 'SettingController@index')->name('settings');

    //Product Category
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::get('/category/{category}/delete', 'CategoryController@destroy')->name('category.destroy');

    //UserPermissionRole
    Route::get('/user', 'UserController@userEdit')->name('user');
    Route::get('/role', 'UserController@roleEdit')->name('role');
});


require __DIR__.'/auth.php';
