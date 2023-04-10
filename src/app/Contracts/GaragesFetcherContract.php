<?php

namespace App\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface GaragesFetcherContract
{
    public function fetch(string $criteria = null, string $criteriaValue = null): Arrayable;
}