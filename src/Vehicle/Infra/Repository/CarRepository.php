<?php

namespace App\Vehicle\Infra\Repository;

use App\Vehicle\Domain\Car;
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
        if (array_key_exists($id, $this->getCars())) {
            return $this->getCars()[$id];
        }

        return null;
    }

    /**
     * @return array
     */
    private function getCars(): array
    {
        return [
            'clio' => new Car('clio', 'Renault', 'Clio 2', 5),
            'cox'  => new Car('cox', 'Volkswagen', 'Coccinelle', 4),
            'polo' => new Car('polo', 'Volkswagen', 'Polo', 5),
        ];
    }
}
