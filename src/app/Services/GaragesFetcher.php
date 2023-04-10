<?php

namespace App\Services;

use http\Exception\InvalidArgumentException;
use Illuminate\Contracts\Support\Arrayable;
use Psr\Container\ContainerInterface;

class GaragesFetcher
{
    /**
     * @var string[]
     */
    protected static $allowedCriterias = [
        'owner',
        'location',
        'country'
    ];

    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string|null $criteria
     * @param string|null $criteriaValue
     * @return Arrayable|\Illuminate\Support\Collection|mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function fetch(string $criteria = null, string $criteriaValue = null)
    {
        if (null === $criteria || !in_array($criteria, static::$allowedCriterias)) {
            return $this->getAllGarages();
        }

        if (in_array($criteria, ['owner', 'country'])) {
            return $this->getFilteredGarages($criteria, $criteriaValue);
        }


        if ('location' === $criteria) {
            return $this->getFilteredGaragesByLocation($criteriaValue);
        }

        throw new InvalidArgumentException('Bad criteria.');
    }

    /**
     * @return Arrayable
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function getAllGarages(): Arrayable
    {
        return $this->container->get('db')->table('garages')
            ->orderBy('garage_id', 'desc')
            ->get();
    }

    /**
     * @param string $criteria
     * @param string $criteriaValue
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function getFilteredGarages(string $criteria, string $criteriaValue): mixed
    {
        return $this->container->get('db')
            ->table('garages')
            ->where($criteria, $criteriaValue)
            ->orderBy('garage_id', 'desc')
            ->get();
    }

    /**
     * @param string $coordinates
     * @return \Illuminate\Support\Collection
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getFilteredGaragesByLocation(string $coordinates)
    {
        [$lat, $lon] = explode(',', $coordinates);

        if (empty($lat) || empty($lon)) return collect(); // empty collection

        $garages = $this->container
            ->get('db')
            ->table('garages')
            ->select('garages.*')
            ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$lat, $lon, $lat])
            ->having('distance', '<', 50) // hardcoded 50km
            ->get();

        if (count($garages) === 0) {
            return $garages;
        }

        return $garages->map(function ($item) {
            unset($item->distance);

            return $item;
        });

    }
}