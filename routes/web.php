<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
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
Route::get("/products/{category?}/{page?}",[ProductController::class,"index","category","page"])->where(["category","page"])->name("products");
Route::get("/product/{slug}",[ProductController::class,"show","slug"])->where(["slug"])->name("product");
Route::get("/about",[AboutController::class,"index"])->name("about");
Route::get("/contact",[ContactController::class,"index"])->name("contact");
Route::get("/cart",[CartController::class,"index"])->name("cart");
Route::post("/cart",[CartController::class,"makeOrder"])->name("order.store");
Route::get("/request/{slug}",[RequestController::class,"makeRequest","slug"])->where(["slug"])->name("request.make");
Route::get("/request/accept/{id}",[RequestController::class,"acceptRequest","id"])->where(["slug"])->name("request.accept");
Route::get("/request/cancel/{id}",[RequestController::class,"cancelRequest","id"])->where(["slug"])->name("request.cancel");
Route::get("/user/profile/{email?}",[\App\Http\Controllers\UserController::class,"index"])->where(["email"])->name("user.profile");
