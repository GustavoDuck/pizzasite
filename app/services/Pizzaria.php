<?php

namespace App\Services;

use App\Models\Pizza;

class Pizzaria
{
    public function fazerPedido(Pizza $pizza): string
    {
        return $pizza->preparar();
    }
}