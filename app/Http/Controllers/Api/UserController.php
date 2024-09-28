<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Response\Message;
use Illuminate\Http\Request;
use App\Helpers\NotFoundHelper;
use App\Functions\GlobalFunctions;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\User\ChangePasswordRequest;

class UserController extends Controller
{
    public function index(Request $request){
        $model = User::get();

        $response = NotFoundHelper::notFoundData($model);
        if ($response) {
            return $response;
        }

        return GlobalFunctions::display(Message::DATA_DISPLAY, $model);
    }
    
    public function show($id){
        $model = User::where("id", $id)->first();
        
        $response = NotFoundHelper::notFoundData($model);
        if ($response) {
            return $response;
        }
        
        return response()->json(['message' => 'success', 'data' => $model], 200);
    }
    
    public function store(StoreRequest $request){
        $model = User::create([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "email" => $request->email_address,
            "password" => $request->password,
            "mobile_number" => $request->mobile_number,
            "birthday" => $request->birthday,
            "gender" => $request->gender,
            "address" => $request->address,
            "house_apartment_no" => $request->house_apartment_no,
            "city" => $request->city,
            "province" => $request->province,
            "country" => $request->country,
            "role_id" => $request->role_id,
            "user_type" => $request->user_type,
            "postal_code" => $request->postal_code
        ]);

        $user_collet = new UserResource($model);

        return GlobalFunctions::created(Message::REGISTERED_SUCCESS, $user_collet);
    }

    public function login(LoginRequest $request){
        $user = User::with("role")
        ->where("email", $request->email)
        ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => [Message::INVALID_CREDENTIALS],
                "password" => [Message::INVALID_CREDENTIALS],
            ]);

            if ($user || Hash::check($request->password, $user->email)) {
                return GlobalFunction::invalid(Message::INVALID_ACTION);
            }
        }

        $token = $user->createToken('PersonalAccessToken')->plainTextToken;
        // $user["token"] = $token;
        $cookie = cookie('rk-shop', $token);

        return GlobalFunctions::login(Message::LOGIN_SUCCESS, $user)->withCookie($cookie);

        // Set the token as an HTTP-only cookie
        // return $response->withCookie(cookie('rk-shop', $token, 60 * 24 * 30, null, null, false, true));

        // Set the token as a regular cookie (not HTTP-only)
        // return $response->withCookie(cookie('rk-shop', $token, 60 * 24 * 30));
    }

    public function change_password(ChangePasswordRequest $request, $id){
        return "me";
    }

    public function logout(Request $request)
    {
        Auth()
            ->user()
            ->currentAccessToken()
            ->delete();
        return GlobalFunctions::display(Message::LOGOUT_USER);
    }

}
