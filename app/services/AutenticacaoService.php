<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutenticacaoService
{
    public function registrar(array $dados): User
    {
        $dados['password'] = Hash::make($dados['password']);
        return User::create($dados);
    }

    public function login(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function usuarioAtual(): ?User
    {
        return Auth::user();
    }
}