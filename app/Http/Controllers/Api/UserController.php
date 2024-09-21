<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\NotFoundHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;

class UserController extends Controller
{
    public function index(){
        $model = User::get();

        $response = NotFoundHelper::notFoundData($model);
        if ($response) {
            return $response;
        }

        return response()->json(['message' => 'success', 'data' => $model], 200);
    }

    public function show($id){
        $model = User::where("id", $id)->first();

        $response = NotFoundHelper::notFoundData($model);
        if ($response) {
            return $response;
        }

        return response()->json(['message' => 'success', 'data' => $model], 200);
    }

    public function login(LoginRequest $request){
        return "success";
    }

    public function register(){
        return "success";
    }
}
