<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleSheetController;
use App\Http\Controllers\UserController;

// Redirect /home to the orders index
Route::get('/home', function () {
    return redirect()->route('orders.index');
})->name('home');

// User registration and login
Route::get('/users', [UserController::class, 'users']);

// Public front page (optional)
Route::get('/', function () {
    return redirect()->route('orders.index');
})->name('front');

// Order creation and submission
Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

// View, edit, update, and delete orders (now public)
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

// Admin dashboard (also now public unless you want to protect it another way)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Google Sheet integration
Route::get('/sheet', [GoogleSheetController::class, 'read'])->name('sheet.read');
