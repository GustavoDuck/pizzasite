<?php

namespace App\Models;

class PizzaCalabresa extends Pizza
{
    public function preparar(): string
    {
        return "Pizza de Calabresa";
    }
}