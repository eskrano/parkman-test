<?php
declare(strict_types=1);

namespace App\Services;

use App\Controllers\Controller;
use DI\Container;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ContainerProxy
{
    public static function withContainer(
        RequestInterface $request,
        ResponseInterface $response,
        $args,
        Container $container,
        string $target
    ): ResponseInterface
    {

        /**
         * @var $controller Controller
         */
        $controller = new $target($request, $response, $args);


        if (null === $controller) {
            return $response->withStatus(404);
        }


        $controller->setContainer($container);

        return $controller->handle();
    }
}