<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// category
Route::get('category/create',[CategoryController::class,'create'])->name('category.create')->middleware('auth');
Route::post('category/store',[CategoryController::class,'store'])->name('category.store')->middleware('auth');
Route::get('category',[CategoryController::class,'index'])->name('category.index')->middleware('auth');
Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit')->middleware('auth');
Route::post('category/update/{id}',[CategoryController::class,'update'])->name('category.update')->middleware('auth');
Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete')->middleware('auth');

// product
Route::get('product/create',[ProductController::class,'create'])->name('product.create')->middleware('auth');
Route::post('product/store',[ProductController::class,'store'])->name('product.store')->middleware('auth');
Route::get('product',[ProductController::class,'index'])->name('product.index')->middleware('auth');
Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit')->middleware('auth');
Route::post('product/update/{id}',[ProductController::class,'update'])->name('product.update')->middleware('auth');
Route::get('product/delete/{id}',[ProductController::class,'delete'])->name('product.delete')->middleware('auth');


require __DIR__.'/auth.php';
