<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
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

    Route::put('/admin/users/{user}/update',[UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/admin/users/{user}/destroy',[UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['role:admin','auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');
    Route::put('/admin/users/{user}/attach',[UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/admin/users/{user}/detach',[UserController::class, 'detach'])->name('user.role.detach');

    Route::get('/admin/roles', [RoleController::class, 'index'])->name('role.index');
    Route::post('/admin/roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::delete('/admin/roles/{role}/destroy',[RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/admin/roles/{role}/edit',[RoleController::class, 'edit'])->name('role.edit');
    Route::patch('/admin/roles/{role}/update',[RoleController::class, 'update'])->name('role.update');

    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/admin/permissions/store', [PermissionController::class, 'store'])->name('permission.store');
});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/admin/users/{user}/profile',[UserController::class, 'show'])->name('user.profile.show');
});
