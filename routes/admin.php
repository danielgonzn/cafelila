<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('galleries', GalleryController::class)->except(['show']);
    Route::resource('contacts', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
});
