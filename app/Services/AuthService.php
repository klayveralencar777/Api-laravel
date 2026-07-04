<?php

namespace App\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService {
    public function login(array $credentials): array{
        $token = Auth::guard('api')->attempt($credentials);

        if(! $token) {
            throw new AuthenticationException('Credenciais inválidas');
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => Auth::guard('api')->user(),
        ];
    }

    public function logout(): void {
        Auth::guard('api')->logout();
    }
    
    public function me() {
        return Auth::guard('api')->user();
    }


}