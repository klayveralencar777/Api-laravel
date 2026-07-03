<?php


namespace App\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService {
    public function login(array $credentials): void{
        $loginSuccess = Auth::attempt($credentials);
        
        if(!$loginSuccess) {
            throw new AuthenticationException('Credenciais inválidas');
        }
    }

    public function logout(): void {
        Auth::logout();
    }
    
    public function me() {
        return Auth::user();
    }


}