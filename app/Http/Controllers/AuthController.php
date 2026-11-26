<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(
        RegisterRequest $request,
        RegisterUserAction $registerUserAction
    ): JsonResponse {
        $result = $registerUserAction->execute($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User registered successfully',
            'data'    => [
                'user'  => $result['user'],
                'token' => $result['token'],
            ],
        ], 201);
    }

    public function login(
        LoginRequest $request,
        LoginUserAction $loginAction
    ): JsonResponse {
        $result = $loginAction->execute($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'User logged in successfully',
            'data'    => [
                'user'  => $result['user'],
                'token' => $result['token'],
            ],
        ], 200);
    }

    public function logout(
        Request $request,
        LogoutAction $logoutAction
    ): JsonResponse {
        $logoutAction->execute($request->user());

        return response()->json([
            'status'  => true,
            'message' => 'User logged out successfully',
        ], 200);
    }
}
