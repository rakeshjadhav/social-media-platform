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

 ################# Implementing user authentication (login and register) and profile update feature. ################

## Implementing user authentication (login and register) and profile update feature.
## This feature branch will focus on implementing the necessary functionality for users to log in, register, and update their profiles.
## Tasks include setting up authentication endpoints, implementing user registration functionality, and allowing users to update their profile information.


Route::prefix("/v1/oauth")->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AccessTokenController::class, 'login']);
});

#### user profile API routes for application
Route::middleware('auth:api')->prefix('/v1/users')->group(function () {
    Route::put("/{user_id}/update-profile", [AuthController::class, "updateUserProfile"]);
});
