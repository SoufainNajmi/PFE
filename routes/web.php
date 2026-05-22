<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Products (public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/fournisseurs/{id}/approve', [AdminController::class, 'approveFournisseur'])->name('admin.fournisseurs.approve');
    Route::post('/fournisseurs/{id}/reject', [AdminController::class, 'rejectFournisseur'])->name('admin.fournisseurs.reject');
});

// Fournisseur Routes
Route::middleware(['auth', 'role:fournisseur'])->prefix('fournisseur')->group(function () {
    Route::get('/dashboard', [FournisseurController::class, 'dashboard'])->name('fournisseur.dashboard');
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::get('/orders', [FournisseurController::class, 'orders'])->name('fournisseur.orders');
    Route::post('/orders/{id}/status', [FournisseurController::class, 'updateOrderStatus'])->name('fournisseur.orders.status');
});

// Client Routes
Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {
    Route::get('/orders', [ClientController::class, 'orders'])->name('client.orders');
    Route::get('/order/create', [ClientController::class, 'createOrder'])->name('client.order.create');
    Route::post('/order/store', [ClientController::class, 'storeOrder'])->name('client.order.store');
    
    // The previous cart routes are still here but we might deprecate them or keep them.
    // We will keep them just in case.
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});
