<?php

use Illuminate\Support\Facades\Route;

Route::get('products-index', [Goodarzi\Inventory\Http\Controllers\ProductController::class, 'productIndex']);

Route::get('products/list', [Goodarzi\Inventory\Http\Controllers\ProductController::class, 'getProducts'])->name('products.list');

Route::get('/', 'Goodarzi\Inventory\Http\Controllers\InventoryCodeController@index')->middleware('auth');
//Route::get('/product_form', 'App\Http\Controllers\ProductController@createProductForm')->name('product_form')->middleware('auth');
//Route::post('/product_form', 'App\Http\Controllers\ProductController@ProductForm')->middleware('auth');

//Route::get('/inventory_code_form', 'App\Http\Controllers\InventoryCodeController@createInventoryCodeForm')->name('inventory_code_form')->middleware('auth');
//Route::post('/inventory_code_form', 'App\Http\Controllers\InventoryCodeController@InventoryCodeForm')->middleware('auth');

//Route::resource('product', 'App\Http\Controllers\ProductController');
//Route::resource('product', 'App\Http\Controllers\ProductController')->middleware('auth');
//Route::resource('inventory_transaction', 'App\Http\Controllers\InventoryTransactionController')->middleware('auth');
//Route::resource('inventory_code', 'App\Http\Controllers\InventoryCodeController')->middleware('auth');

Route::group(['middleware' => ['web', 'auth']], function(){

    Route::get('/product_search', [Goodarzi\Inventory\Http\Controllers\ProductController::class, 'search']);


    Route::get('/inventory_codes/export', 'Goodarzi\Inventory\Http\Controllers\InventoryCodeController@export')->name('inventory_codes.export');
    Route::get('/products/export', 'Goodarzi\Inventory\Http\Controllers\ProductController@export')->name('products.export');
    Route::get('/inventory_transactions/addition', [
        'uses' => 'Goodarzi\Inventory\Http\Controllers\InventoryTransactionController@createInventoryTransactionAddition'
    ])->name('inventory_transactions_addition');
    
    // Post form data
    Route::post('/inventory_transactions/addition', [
        'uses' => 'Goodarzi\Inventory\Http\Controllers\InventoryTransactionController@store',
        'as' => 'inventory_transactions_addition.store'
    ]);
    
    Route::get('/inventory_transactions/removal', [
        'uses' => 'Goodarzi\Inventory\Http\Controllers\InventoryTransactionController@createInventoryTransactionRemoval'
    ])->name('inventory_transactions_removal');
    
    // Post form data
    Route::post('/inventory_transactions/removal', [
        'uses' => 'Goodarzi\Inventory\Http\Controllers\InventoryTransactionController@store',
        'as' => 'inventory_transactions_removal.store'
    ]);


    //Route::get('/products/{sku}')->uses('Goodarzi\Inventory\Http\Controllers\ProductController@index');

    // **** above route should define before below routes

    Route::resource('products', Goodarzi\Inventory\Http\Controllers\ProductController::class);
    Route::resource('inventory_transactions', Goodarzi\Inventory\Http\Controllers\InventoryTransactionController::class);
    Route::resource('inventory_codes', Goodarzi\Inventory\Http\Controllers\InventoryCodeController::class);
    Route::resource('sources', Goodarzi\Inventory\Http\Controllers\SourceController::class);
    Route::resource('stocks', Goodarzi\Inventory\Http\Controllers\StockController::class);


});
