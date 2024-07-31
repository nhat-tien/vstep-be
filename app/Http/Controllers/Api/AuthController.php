<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Api\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $auth)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->auth->login($request->safe()->only(["email", "password"]));

            return ;
        return response()->json([
                "status" => 200,
                'message' => 'Login Successful',
                'token' => $token->plainTextToken,
                'tokenType' => 'Bearer',
                'user' => new UserResource($user),
            ], $response['status']);
    }

    public function register(RegisterRequest $request): JsonResponse
    {

        $response = $this->auth->register($request->safe()->only(["name","email", "password"]));
        return response()->json($response, $response['status']);
    }
    public function logout(Request $request): JsonResponse
    {
        $response = $this->auth->logout($request);
        return response()->json($response, $response['status']);
    }
}
