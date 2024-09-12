<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthenticateController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.layouts.master', ['title' => 'Dashboard']);
})->middleware('auth')->name('dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/login', [AuthenticateController::class, 'login'])->name('login')->middleware('auth.logIn');
    Route::post('/login', [AuthenticateController::class, 'postLogin'])->name('postLogin');
    Route::get('register', [AuthenticateController::class, 'register'])->name('register')->middleware('auth.logIn');
    Route::post('register', [AuthenticateController::class, 'postRegister'])->name('postRegister');
    Route::get('logout', [AuthenticateController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'roles', 'as' => 'roles.'], function() {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::put('/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy');
    Route::get('/search', [RoleController::class, 'search'])->name('search');
});

Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/api/list', [ProductController::class, 'getListProductApi'])->name('api.list');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    Route::put('/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
});


Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {    
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');  
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');  
    Route::get('/search', [CategoryController::class, 'search'])->name('search');
});

// Route::resource('categories', CategoryController::class);
