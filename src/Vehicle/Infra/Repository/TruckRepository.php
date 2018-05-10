<?php

namespace App\Vehicle\Infra\Repository;

use App\Vehicle\Domain\Truck;
use App\Vehicle\Domain\VehicleInterface;
use App\Vehicle\Domain\VehicleRepositoryInterface;

class TruckRepository implements VehicleRepositoryInterface
{
    /**
     * @param string $id
     * @return VehicleInterface
     */
    public function find(string $id): ?VehicleInterface
    {
        if (array_key_exists($id, $this->getTrucks())) {
            return $this->getTrucks()[$id];
        }

        return null;
    }

    /**
     * @return array
     */
    private function getTrucks(): array
    {
        return [
            'ateam' => new Truck('ateam', 'GMC', 'Vandura', 1000),
            'dumb'  => new Truck('dumb', 'Ford', 'Econoline', 600),
            'fear'  => new Truck('fear', 'Corbitt', '50SD6', 5000),
        ];
    }
}
