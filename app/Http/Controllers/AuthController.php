<?php

namespace App\Http\Controllers;

use App\Services\AutenticacaoService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $autenticacaoService;

    public function __construct(AutenticacaoService $autenticacaoService)
    {
        $this->autenticacaoService = $autenticacaoService;
    }

    public function registrar(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = $this->autenticacaoService->registrar($dados);
        return response()->json($usuario, 201);
    }

    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($this->autenticacaoService->login($dados['email'], $dados['password'])) {
            return response()->json(['message' => 'Login bem-sucedido']);
        }

        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    public function logout()
    {
        $this->autenticacaoService->logout();
        return response()->json(['message' => 'Logout bem-sucedido']);
    }

    public function usuarioAtual()
    {
        $usuario = $this->autenticacaoService->usuarioAtual();
        return response()->json($usuario);
    }
}