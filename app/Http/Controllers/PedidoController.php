<?php

namespace App\Http\Controllers;

use App\Models\PizzaCalabresa;
use App\Models\PizzaMarguerita;
use App\Models\PizzaPortuguesa;
use App\Models\Pedido;
use App\Models\Pagamento;
use App\Services\Pizzaria;
use App\Services\GerenciadorPedidos;
use App\Services\ProcessadorPagamento;

class PedidoController extends Controller
{
    protected $pizzaria;
    protected $gerenciadorPedidos;
    protected $processadorPagamento;

    public function __construct(Pizzaria $pizzaria, GerenciadorPedidos $gerenciadorPedidos, ProcessadorPagamento $processadorPagamento)
    {
        $this->pizzaria = $pizzaria;
        $this->gerenciadorPedidos = $gerenciadorPedidos;
        $this->processadorPagamento = $processadorPagamento;
    }

    public function fazerPedido(string $tipo, int $quantidade)
    {
        switch ($tipo) {
            case 'calabresa':
                $pizza = new PizzaCalabresa();
                break;
            case 'marguerita':
                $pizza = new PizzaMarguerita();
                break;
            case 'portuguesa':
                $pizza = new PizzaPortuguesa();
                break;
            default:
                return "Pizza não disponível.";
        }

        $pedido = new Pedido($pizza, $quantidade);
        $this->gerenciadorPedidos->adicionarPedido($pedido);

        return $pedido->totalizar();
    }

    public function listarPedidos()
    {
        $pedidos = $this->gerenciadorPedidos->listarPedidos();
        return response()->json($pedidos);
    }

    public function pagarPedido(int $pedidoIndex)
    {
        $pedidos = $this->gerenciadorPedidos->listarPedidos();

        if (!isset($pedidos[$pedidoIndex])) {
            return "Pedido não encontrado.";
        }

        $pedido = $pedidos[$pedidoIndex];
        $valor = $pedido->getQuantidade() * 20; // Supondo que cada pizza custa 20

        $pagamento = new Pagamento($pedido, $valor);
        $resultadoPagamento = $this->processadorPagamento->processarPagamento($pagamento);

        return $resultadoPagamento;
    }
}