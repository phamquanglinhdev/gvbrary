<?php

use App\Http\Controllers\Admin\DraftCrudController;
use App\Http\Controllers\Admin\PostCrudController;
use App\Http\Controllers\Admin\ProductCrudController;
use App\Http\Controllers\XUploadController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('category', 'CategoryCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('review', 'ReviewCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('request', 'RequestCrudController');
    Route::crud('notification', 'NotificationCrudController');
    Route::crud('verification', 'VerificationCrudController');
    Route::crud('history', 'HistoryCrudController');
    Route::crud('comment', 'CommentCrudController');
    Route::crud('coin', 'CoinCrudController');
    Route::crud('post', 'PostCrudController');
    Route::get('x-upload',[XUploadController::class,"index"])->name("xupload");
    Route::post('x-upload',[XUploadController::class,"upload"])->name("xupload.upload");
    Route::get('draft',[ProductCrudController::class,"draft"])->name("draft");
    Route::get('draft/{slug}',[ProductCrudController::class,"showDraft","slug"])->where(["slug"])->name("show-draft");
    Route::get('draft/{id}/accept',[ProductCrudController::class,"acceptDraft","id"])->where(["id"])->name("accept-draft");
    Route::get('draft/{id}/deny',[ProductCrudController::class,"denyDraft","id"])->where(["id"])->name("deny-draft");
    Route::get("post/create",[PostCrudController::class,"customCreatePost"])->name("post.create");
    Route::get("post/{id}/edit",[PostCrudController::class,"customUpdatePost","id"])->where(["id"])->name("post.edit");
    Route::put("post/{id}",[PostCrudController::class,"updatedPost","id"])->where(["id"])->name("post.update");
    Route::get("post/{id}/change-status/{status}",[PostCrudController::class,"changeStatus","id","status"])->where(["id","status"])->name("post.change-status");
    Route::crud('tag', 'TagCrudController');
}); // this should be the absolute last line of this file