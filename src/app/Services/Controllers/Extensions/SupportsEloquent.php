<?php
declare(strict_types=1);

namespace App\Services\Controllers\Extensions;

use Illuminate\Database\Connection;

trait SupportsEloquent
{
    public function getEloquent(): Connection
    {
        return $this->getContainer()->get('db');
    }
}