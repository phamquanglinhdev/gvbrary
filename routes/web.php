<?php

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

Route::get('/',[\App\Http\Controllers\IndexController::class,"index"])->name("index");
Route::get("/products/{category?}/{page?}",[\App\Http\Controllers\ProductController::class,"index","category","page"])->where(["category","page"])->name("products");
Route::get("/product/{slug?}",[\App\Http\Controllers\ProductController::class,"show","slug"])->where(["slug"])->name("product");
Route::get("/about",[\App\Http\Controllers\AboutController::class,"index"])->name("about");
Route::get("/contact",[\App\Http\Controllers\ContactController::class,"index"])->name("contact");
