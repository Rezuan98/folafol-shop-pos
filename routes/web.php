<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\JuiceController;
use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\IngredientController;
use App\Http\Controllers\Backend\ReportController;
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





// Ingredient Management
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');
Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
Route::get('/ingredients/low-stock', [IngredientController::class, 'lowStock'])->name('ingredients.low-stock');
Route::get('/ingredients/{ingredient}/adjust-stock', [IngredientController::class, 'showAdjustStock'])->name('ingredients.show-adjust-stock');
Route::post('/ingredients/{ingredient}/adjust-stock', [IngredientController::class, 'adjustStock'])->name('ingredients.adjust-stock');
Route::get('/ingredients/{ingredient}/stock-history', [IngredientController::class, 'stockHistory'])->name('ingredients.stock-history');



// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
Route::get('/reports/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');
Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
Route::get('/reports/download', [ReportController::class, 'downloadReport'])->name('reports.download');





// User Management
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');







});

