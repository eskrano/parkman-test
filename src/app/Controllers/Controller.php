<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\Controllers\SupportsContainer;
use App\Contracts\Controllers\SupportsEloquent;
use App\Contracts\Controllers\SupportsRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Controller implements SupportsContainer, SupportsRequest, SupportsEloquent
{
    use \App\Services\Controllers\Extensions\SupportsContainer,
        \App\Services\Controllers\Extensions\SupportsRequest,
        \App\Services\Controllers\Extensions\SupportsEloquent;


    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        $args
    )
    {
        $this->captureRequest($request, $response, $args);
    }

    public abstract function handle(): ResponseInterface;
}