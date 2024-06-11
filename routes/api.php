<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccessTokenController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix("/v1/oauth")->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AccessTokenController::class, 'login']);
});

Route::middleware('auth:api')->prefix('/v1/users')->group(function () {

    Route::put("/{user_id}/update-profile", [AuthController::class, "updateUserProfile"]);

});
