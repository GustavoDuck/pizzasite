<?php

namespace App\Models;

abstract class Pizza
{
    abstract public function preparar(): string;
}

