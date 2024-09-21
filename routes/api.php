<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(["middleware" => ["auth:sanctum"]], function () {

});
Route::apiResource("users", UserController::class);
Route::post("login", [UserController::class, "login"]);
Route::post("user/register", [UserController::class, "register"]);