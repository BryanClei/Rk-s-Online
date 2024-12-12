<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Response\Message;
use Illuminate\Http\Request;
use App\Helpers\NotFoundHelper;
use App\Functions\GlobalFunctions;
use App\Services\Users\UserServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\User\ChangePasswordRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServices $userService)
    {
        $this->userServices = $userService;
    }

    public function index(Request $request)
    {
        $model = User::useFilters()->dynamicPaginate();

        $response = NotFoundHelper::notFoundData($model);
        if ($response) {
            return $response;
        }

        return GlobalFunctions::display(Message::DATA_DISPLAY, $model);
    }

    public function show($id)
    {
        $model = User::where("id", $id)->first();

        $response = NotFoundHelper::notFoundData($model);
        if ($response) {
            return $response;
        }

        return response()->json(
            ["message" => "success", "data" => $model],
            200
        );
    }

    public function store(StoreRequest $request)
    {
        $post = $this->userServices->createUser($request->validated());

        $user_collet = new UserResource($post);

        return GlobalFunctions::created(
            Message::REGISTERED_SUCCESS,
            $user_collet
        );
    }

    public function login(LoginRequest $request)
    {
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

        $user->update([
            "online_status" => 1,
        ]);

        $token = $user->createToken("PersonalAccessToken")->plainTextToken;
        $user["token"] = $token;
        $cookie = cookie("rk-shop", $token);

        return GlobalFunctions::login(
            Message::LOGIN_SUCCESS,
            $user
        )->withCookie($cookie);

        // Set the token as an HTTP-only cookie
        // return $response->withCookie(cookie('rk-shop', $token, 60 * 24 * 30, null, null, false, true));

        // Set the token as a regular cookie (not HTTP-only)
        // return $response->withCookie(cookie('rk-shop', $token, 60 * 24 * 30));
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $id = Auth::id();
        $user = User::find($id);

        return $this->userServices->change_password(
            $user,
            $request->current_password,
            $request->new_password
        );
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->update(["online_status" => 0]);
        $user->currentAccessToken()->delete();
        return GlobalFunctions::display(
            Message::LOGOUT_USER,
            $user->online_status
        );
    }
}
