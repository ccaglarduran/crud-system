<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController; // 1. Controller'ı yukarıya import ettik
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Sadece giriş yapmış (auth) kullanıcılar erişebilir
Route::middleware('auth')->group(function () {
    // Profil rotaları (Breeze ile gelenler)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bizim CRUD Sisteminin Ana Rotası
    Route::resource('users', UserController::class);

    // ==========================================
    // SAĞLAM TODO SİSTEMİ ROTALARI (BURAYA EKLEDİK)
    // ==========================================
    // Tüm temel CRUD işlemlerini (index, store, update, destroy) tek satırda çözer
    Route::resource('todos', TodoController::class);
    
    // Todo'nun durumunu hızlıca (yapıldı/yapılmadı) değiştirmek için özel PATCH rotası
    Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
});

require __DIR__.'/auth.php';