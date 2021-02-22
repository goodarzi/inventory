<?php

use Illuminate\Support\Facades\Route;
use Goodarzi\Inventory\Http\Controllers\ProductController;
use Goodarzi\Inventory\Http\Controllers\InventoryCodeController;
use Goodarzi\Inventory\Http\Controllers\InventoryTransactionController;
use Goodarzi\Inventory\Http\Controllers\StockController;
use Goodarzi\Inventory\Http\Controllers\SourceController;

use Goodarzi\Inventory\Models\Product;

Route::get('products-index', [ProductController::class, 'productIndex']);

Route::get('products/list', [ProductController::class, 'getProducts'])->name('products.list');

Route::get('/', 'Goodarzi\Inventory\Http\Controllers\InventoryCodeController@index')->middleware('auth');


Route::group(['middleware' => ['web', 'auth']], function(){

    Route::get('/product_autocomplete', [ProductController::class, 'query']);
    Route::get('/inventory_code_autocomplete', [InventoryCodeController::class, 'query']);
    Route::get('/inventory_transaction/product_search', [InventoryTransactionController::class, 'productQuery']);
    Route::get('/inventory_transaction/inventory-code_search', [InventoryTransactionController::class, 'inventoryCodeQuery']);


    Route::get('/product_search', [ProductController::class, 'search']);


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

    // **** resource routes should define after other routes

    Route::resource('products', ProductController::class);
    Route::resource('inventory_transactions', InventoryTransactionController::class);
    Route::resource('inventory_codes', InventoryCodeController::class);
    Route::resource('sources', SourceController::class);
    Route::resource('stocks', StockController::class);


});
