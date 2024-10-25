<?php

namespace App\Models;

class PizzaPortuguesa extends Pizza
{
    public function preparar(): string
    {
        return "Pizza de Portuguesa";
    }
}