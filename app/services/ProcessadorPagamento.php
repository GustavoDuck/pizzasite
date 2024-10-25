<?php

namespace App\Services;

use App\Models\Pagamento;

class ProcessadorPagamento
{
    public function processarPagamento(Pagamento $pagamento): string
    {
        return $pagamento->processar();
    }
}