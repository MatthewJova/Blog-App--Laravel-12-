<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('post-register', [AuthController::class, 'postRegister'])->name('post.register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');