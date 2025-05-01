<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;

// Show Login Form (GET)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.show');

// Process Login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Show Register Form (GET)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');

// Process Registration (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bills', BillController::class);
    Route::resource('services', ServiceController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});