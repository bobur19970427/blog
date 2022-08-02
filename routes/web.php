<?php

use App\Http\Controllers\Auth\AuthController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [PostController::class, 'index'])->name('posts.all');
Route::get('/detail/{id}', [PostController::class, 'show'])->name('posts.detail');
Route::get('/add-post', [PostController::class,'create'])->name('posts.create');
Route::post('/add-post', [PostController::class, 'store'])->name('posts.addpostsubmit');
Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/update-post/{id}', [PostController::class, 'update'])->name('post.updatesubmit');
Route::get('/delete-post/{id}', [PostController::class, 'destroy'])->name('post.delete');


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/registration', [AuthController::class, 'registration'])->name('register');
Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




