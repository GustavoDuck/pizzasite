<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;

Route::post('/registrar', [AuthController::class, 'registrar']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/usuario', [AuthController::class, 'usuarioAtual'])->middleware('auth');
Route::get('/pedidos', [PedidoController::class, 'listarPedidos']);
Route::get('/pedido/{tipo}/{quantidade}', [PedidoController::class, 'fazerPedido']);
Route::get('/pagamento/{pedidoIndex}', [PedidoController::class, 'pagarPedido']);
Route::get('/pedido/{tipo}/{quantidade}', [PedidoController::class, 'fazerPedido']);
Route::get('/pedidos', [PedidoController::class, 'listarPedidos']);


// Definindo a rota para a página inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');
