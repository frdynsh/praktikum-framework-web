<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Rute GET sederhana
Route::get('/hello', function () {
    return 'Hello, World!';
});

// Rute dengan parameter
Route::get('/user/{id}', function ($id) {
    return "User ID: ". $id;
});

// Rute dengan parameter opsional
Route::get('/users/{name?}', function ($name = 'Guest') {
    return "Hello, ". $name;
});

// Rute dengan nama
Route::get('/profiles', function () {
    return "This is the profile page.";
})->name('profiles');
// Menggunakan rute bernama untuk redirect
Route::get('/redirect-to-profiles', function () {
    return redirect()->route('profiles');
});

// Rute Group dengan prefix
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Admin Dashboard";
    });

    Route::get('/profiles', function () {
        return "Admin Profiles";
    });
});


Route::get('/', function () {
    return view('welcome');
});

// Rute dengan middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'RoleCheck:admin'])->name('dashboard');

Route::middleware(['auth', 'verified', 'RoleCheck:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute resource untuk CRUD
Route::get('/product', [ProductController::class, 'index'])->name('product-index');
Route::get('/product/create', [ProductController::class, 'create'])->name("product-create");
Route::post('/product', [ProductController::class, 'store'])->name("product-store");
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product-detail'); // PERTEMUAN 9
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product-edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product-update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product-deleted');

require __DIR__.'/auth.php';
