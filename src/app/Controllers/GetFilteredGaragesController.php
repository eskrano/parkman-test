<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\GaragesFetcherContract;
use Psr\Http\Message\ResponseInterface;

class GetFilteredGaragesController extends Controller
{

    /**
     * @return ResponseInterface
     */
    public function handle(): ResponseInterface
    {

        $data = $this->getContainer()
            ->get(GaragesFetcherContract::class)
            ->fetch(
                $this->getArgs()['criteria'],
                $this->getArgs()['criteriaValue']
            );

        return $this->jsonResponse(['garages' => $data]);
    }
}