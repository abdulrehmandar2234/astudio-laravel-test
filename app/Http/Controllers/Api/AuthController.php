<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->only('first_name', 'last_name', 'email') + ['password' => bcrypt($request->password)]);

        return response()->json(['token' => $user->createToken('MyApp')->accessToken], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (auth()->attempt($request->validated())) {
            return response()->json(['token' => auth()->user()->createToken('API Token')->accessToken]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->token()->revoke();

        return response()->json(['message' => 'You have been successfully logged out!']);
    }
}
