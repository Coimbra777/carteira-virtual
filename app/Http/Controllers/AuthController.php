<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Helpers\ApiResponse;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'user'    => $result['user'],
            'token'   => $result['token'],
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return ApiResponse::success(null, 'Logged out successfully');
    }
}
