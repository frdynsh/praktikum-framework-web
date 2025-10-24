<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// PERTEMUAN 2
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';