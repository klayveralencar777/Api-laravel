<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController {

    public function __construct( private AuthService $service){}

    public function login(LoginRequest $request) : JsonResponse{
        $payload = $this->service->login($request->validated());

        return response()->json([
            'message' => 'login realizado com sucesso!',
            'access_token' => $payload['access_token'],
            'user' => $payload['user'],
        ]);

    }

    public function logout() : JsonResponse
    {
        $this->service->logout();

        return response()->json([
            'message' => 'logout realizado com sucesso!',
        ]);

    }

    public function me() : JsonResponse
    {
        return response()->json([
            'user' => $this->service->me(),
        ]);

    }
}