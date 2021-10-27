<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/admin/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts', [PostController::class, 'index'])->name('post.index');

    Route::get('/admin/posts/{post}/edit',[PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/posts/{post}/update',[PostController::class, 'update'])->name('post.update');
    Route::delete('/admin/posts/{post}/destroy',[PostController::class, 'destroy'])->name('post.destroy');

    //Route::get('/admin/users', [userController::class, 'index'])->name('user.index');
    //Route::get('/admin/users/{user}/profile',[UserController::class, 'show'])->name('user.profile.show');
    Route::put('/admin/users/{user}/update',[UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/admin/users/{user}/destroy',[UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['role:admin','auth'])->group(function () {
    Route::get('/admin/users', [userController::class, 'index'])->name('user.index');
});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/admin/users/{user}/profile',[UserController::class, 'show'])->name('user.profile.show');
});
