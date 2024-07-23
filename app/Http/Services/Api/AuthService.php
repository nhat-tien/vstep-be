<?php

namespace App\Http\Services\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct()
    {
    }

    /**
     * @return array<string,mixed>|array
     * @param array<int,mixed> $credential
     */
    public function login(array $credential): array
    {
        try {
            if(!Auth::attempt($credential)) {
                return [
                    'status' => 401,
                    'message' => 'Email or password incorrect',
                ];
            }

            $user = Auth::user();
            $token = $user->createtoken('access_token');

            return [
                "status" => 200,
                'message' => 'Login Successful',
                'token' => $token->plainTextToken,
                'tokenType' => 'Bearer',
                'user' => new UserResource($user),
            ];
        } catch(\Throwable $th) {
            return [
                 'status' => 500,
                 'message' => $th->getMessage()
             ];
        }
    }

    /**
     * @return array<string,mixed>|array
     * @param array<int,mixed> $credential
     */
    public function register(array $credential): array
    {
        try {
            $user = User::where('email', $credential['email'])->first();

            if(!($user === null)) {
                return [
                    'status' => 409,
                    'message' => 'User already exists',
                ];
            }
            $user = User::create([
                           'name' => $credential['name'],
                           'email' => $credential['email'],
                           'password' => Hash::make($credential['password']),
                           'role' => 'candidate',
                       ]);

            Auth::login($user);

            $token = $user->createtoken('access_token');

            return [
                "status" => 200,
                'message' => 'User Created Successful',
                'token' => $token->plainTextToken,
                'tokenType' => 'Bearer',
                'user' => new UserResource($user),
            ];
        } catch(\Throwable $th) {
            return [
                 'status' => 500,
                 'message' => $th->getMessage()
             ];
        }
    }

    /**
     * @return array<string,mixed>
     */
    public function logout(Request $request): array
    {
        try {

            $request->user()->currentAccessToken()->delete();

            return [
                "status" => 200,
                'message' => 'Logout Successful',
            ];
        } catch(\Throwable $th) {
            return [
                 'status' => 500,
                 'message' => $th->getMessage()
             ];
        }
    }
}
