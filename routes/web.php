<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}/', [PostController::class, 'show'])->name('posts.show');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
	Route::post('/search', [HomeController::class, 'searched'])->name('searched');
	Route::get('/search', [HomeController::class, 'search'])->name('search');
	Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
	Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
	Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
	Route::post('/post/store', [PostController::class, 'store'])->name('posts.store');
	Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('posts.update');
	Route::post('/post/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
	Route::post('/post/{id}/comments/store', [PostController::class, 'store_comment'])->name('posts.comments.store');
	Route::delete('/comment/{id}/destroy', [PostController::class, 'destroy_comment'])->name('posts.comments.destroy');
	Route::post('/comment/{id}/restore', [PostController::class, 'restore_comment'])->name('posts.comments.restore');
});