<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController {

    public function __construct( private AuthService $service){}

    public function login(LoginRequest $request) : JsonResponse{

        $this->service->login($request->validated());
        return response()->json(['message' => 'login realizado com sucesso!']);

    }
}