<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
});
