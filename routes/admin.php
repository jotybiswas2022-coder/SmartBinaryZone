<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TotalSellController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\BannerController;

Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Contact messages
    Route::get('/contact', [DashboardController::class, 'contact'])->name('admin.contact');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Total Sell
    Route::get('/total-sell', [TotalSellController::class, 'index'])->name('admin.total-sell');

    // Banner
    Route::get('/banner', [BannerController::class, 'index'])->name('admin.banner');
    Route::post('/banner/upload', [BannerController::class, 'upload'])->name('admin.banner.upload');
    Route::post('/banner/remove', [BannerController::class, 'remove'])->name('admin.banner.remove');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
});
