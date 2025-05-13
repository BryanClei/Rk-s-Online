<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoriesController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource("users", UserController::class);
Route::apiResource("products", ProductController::class);
Route::group(["middleware" => ["auth:sanctum"]], function () {
    //Change password
    Route::patch("users/change_password/{id}", [
        UserController::class,
        "change_password",
    ]);

    //Logout
    Route::post("logout", [UserController::class, "logout"]);

    //User Controller

    //Role Controller
    Route::apiResource("roles", RoleController::class);

    //Categories Controller
    Route::delete("categories/delete_permanent/{id}", [
        CategoriesController::class,
        "delete",
    ]);
    Route::apiResource("categories", CategoriesController::class);

    //Products Controller
});

Route::post("login", [UserController::class, "login"]);
