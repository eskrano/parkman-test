<?php
declare(strict_types=1);

namespace App\Contracts\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface  SupportsRequest
{
    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * @return mixed
     */
    public function getArgs(): mixed;

    /**
     * @param array $data
     * @param int $status
     * @return ResponseInterface
     */
    public function jsonResponse(array $data, int $status = 200): ResponseInterface;
}