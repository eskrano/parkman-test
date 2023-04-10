<?php
declare(strict_types=1);

namespace App\Services\Controllers\Extensions;

use DI\Container;

trait SupportsContainer
{
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * @param Container $container
     * @return void
     */
    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    protected function getContainer(): Container
    {
        return $this->container;
    }
}