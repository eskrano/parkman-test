<?php
declare(strict_types=1);

namespace App\Services\Controllers\Extensions;

use Illuminate\Contracts\Support\Arrayable;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

trait SupportsRequest
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @var mixed
     */
    private mixed $args;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return void
     */
    public function captureRequest(
        RequestInterface $request,
        ResponseInterface $response,
        $args
    ): void
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getArgs(): mixed
    {
        return $this->args;
    }

    /**
     * @param $data
     * @param int $status
     * @return ResponseInterface
     */
    public function jsonResponse($data, int $status = 200): ResponseInterface
    {
        $response = $this->getResponse();

        $content = null;

        if ($data instanceof Arrayable) {
            $content = json_encode($data->toArray());
        } else if (is_array($data)) {
            $content = json_encode($data);
        } else if (is_string( $data) || is_numeric($data)) {
            $content = json_encode(['result' => $data]);
        }

        $response
            ->getBody()
            ->write($content);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);

    }
}