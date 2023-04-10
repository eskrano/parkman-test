<?php
declare(strict_types=1);

namespace App\Contracts\Controllers;

use Illuminate\Database\Connection;

interface SupportsEloquent
{
    public function getEloquent(): Connection;
}