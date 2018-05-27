<?php

namespace App\Vehicle\Infra\Repository;

use App\Common\Infra\Repository\DataRepository;
use App\Vehicle\Domain\VehicleInterface;
use App\Vehicle\Domain\VehicleRepositoryInterface;

class CarRepository implements VehicleRepositoryInterface
{
    /**
     * @param string $id
     * @return VehicleInterface
     */
    public function find(string $id): ?VehicleInterface
    {
        if (array_key_exists($id, DataRepository::getCars())) {
            return DataRepository::getCars()[$id];
        }

        return null;
    }
}
