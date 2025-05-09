<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\JuiceController;
use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Backend\PosController;

// Admin routes


 Route::get('/', [IndexController::class, 'index'])->name('admin.dashboard');
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
   
    
    // Juice Management
    Route::get('/juices', [JuiceController::class, 'index'])->name('juices.index');
    Route::get('/juices/create', [JuiceController::class, 'create'])->name('juices.create');
    Route::post('/juices', [JuiceController::class, 'store'])->name('juices.store');
    Route::get('/juices/{juice}/edit', [JuiceController::class, 'edit'])->name('juices.edit');
    Route::put('/juices/{juice}', [JuiceController::class, 'update'])->name('juices.update');
    Route::delete('/juices/{juice}', [JuiceController::class, 'destroy'])->name('juices.destroy');
    
 
   

// POS System
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::get('/pos/juice/{id}', [PosController::class, 'getJuiceDetails'])->name('pos.get-juice');
Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
Route::get('/pos/orders', [PosController::class, 'orders'])->name('pos.orders');
Route::get('/pos/orders/{id}', [PosController::class, 'orderDetails'])->name('pos.order-details');
Route::get('/pos/print-receipt/{id}', [PosController::class, 'printReceipt'])->name('pos.print-receipt');
});