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
    // Export Route (Harus di atas agar tidak tertabrak route show)
    Route::get('/export-bills-xlsx', [BillController::class, 'exportXlsx'])->name('bills.export');

    // Index
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    
    // Create Form
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    
    // Store
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
    
    // Show
    Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
    
    // Edit Form
    Route::get('/bills/{bill}/edit', [BillController::class, 'edit'])->name('bills.edit');
    
    // Update
    Route::put('/bills/{bill}', [BillController::class, 'update'])->name('bills.update');
    
    // Delete
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');

    Route::get('/export-services-xlsx', [ServiceController::class, 'exportXlsx'])
     ->name('services.export');

    
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('services', ServiceController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});