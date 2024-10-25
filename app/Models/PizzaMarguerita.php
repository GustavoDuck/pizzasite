<?php

namespace App\Models;

class PizzaMarguerita extends Pizza
{
    public function preparar(): string
    {
        return "Pizza de Marguerita";
    }
}