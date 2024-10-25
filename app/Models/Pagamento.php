<?php

namespace App\Models;

class Pagamento
{
    private $pedido;
    private $valor;
    private $status;

    public function __construct(Pedido $pedido, float $valor)
    {
        $this->pedido = $pedido;
        $this->valor = $valor;
        $this->status = 'pendente';
    }

    public function processar(): string
    {
        // Simulação de processamento de pagamento
        $this->status = 'pago';
        return "Pagamento de {$this->valor} para o pedido de {$this->pedido->totalizar()} foi processado.";
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}