<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');
