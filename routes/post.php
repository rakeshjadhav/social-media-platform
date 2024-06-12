<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:api')->prefix('/v1/post')->group(function () {

   #### post resource apis 
   Route::post("/create-post", [PostController::class, "createPost"]);
   Route::put("/{post_id}/update-post", [PostController::class, "updatePost"]);
   Route::get("/details-post/{post_id}", [PostController::class, "getPostDetails"]);
   Route::put("/delete-post/{post_id}", [PostController::class, "deleteSupplierData"]);

   
});

#### user post comment API routes without middleware 
Route::prefix("/v1/post")->group(function () {
   Route::post("/{post_id}/comments", [CommentController::class, "storePostComment"]);
   Route::post('/comments/{comment_id}/likes', [CommentController::class, 'storeCommentLike']);
});
