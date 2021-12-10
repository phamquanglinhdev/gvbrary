<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
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

Route::get('/',[IndexController::class,"index"])->name("index");
Route::get("/products/{category?}/{page?}",[ProductController::class,"index","category","page"])->where(["category","page"])->name("products");
Route::get("/product/{slug}",[ProductController::class,"show","slug"])->where(["slug"])->name("product");
Route::get("/about",[AboutController::class,"index"])->name("about");
Route::get("/contact",[ContactController::class,"index"])->name("contact");
Route::get("/cart",[CartController::class,"index"])->name("cart");
Route::post("/cart",[CartController::class,"makeOrder"])->name("order.store");
Route::get("/verification",[VerificationController::class,"index"])->name("user.verification");
Route::post("/verification/store",[VerificationController::class,"store"])->name("user.verification.store");
Route::get("/verification/{id}/accept",[VerificationController::class,"accept"])->name("user.verification.accept");
Route::get("/verification/{id}/cancel",[VerificationController::class,"cancel"])->name("user.verification.cancel");
Route::post("/request/",[RequestController::class,"makeRequest"])->name("request.make");
Route::get("/request/accept/{id}",[RequestController::class,"acceptRequest","id"])->where(["slug"])->name("request.accept");
Route::get("/request/cancel/{id}",[RequestController::class,"cancelRequest","id"])->where(["slug"])->name("request.cancel");
Route::get("/user/profile/{email?}",[UserController::class,"index"])->where(["email"])->name("user.profile");
Route::get("/user/notification",[NotificationController::class,"index"])->name("user.notification");
Route::get("/user/notification/read",[NotificationController::class,"read"])->name("user.notification.read");
Route::get("/user/history",[\App\Http\Controllers\HistoryController::class,"index"])->name("user.history");
Route::post("/comment/store",[\App\Http\Controllers\ProductController::class,"requestComment"])->name("comment.store");
