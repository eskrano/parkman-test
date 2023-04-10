<?php
declare(strict_types=1);

namespace App\Contracts\Controllers;

use DI\Container;

interface SupportsContainer
{
    /**
     * @param Container $container
     * @return mixed
     */
    public function setContainer(Container $container);
}