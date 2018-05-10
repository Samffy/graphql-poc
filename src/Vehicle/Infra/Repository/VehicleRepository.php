<?php

namespace App\Vehicle\Infra\Repository;

use App\Person\Domain\Person;
use App\Vehicle\Domain\VehicleInterface;

class VehicleRepository
{
    /**
     * @param CarRepository $carRepository
     * @param TruckRepository $truckRepository
     */
    public function __construct(CarRepository $carRepository, TruckRepository $truckRepository)
    {
        $this->carRepository = $carRepository;
        $this->truckRepository = $truckRepository;
    }

    /**
     * @param Person $person
     * @return VehicleInterface|null
     */
    public function findByPerson(Person $person): ?VehicleInterface
    {

        if (array_key_exists($person->getId(), $this->getVehicles())) {
            return $this->getVehicles()[$person->getId()];
        }

        return null;
    }

    /**
     * @return array
     */
    private function getVehicles(): array
    {
        return [
            'duffy'  => $this->carRepository->find('cox'),
            'chuck'  => $this->truckRepository->find('ateam'),
            'milano' => $this->carRepository->find('clio'),
        ];
    }
}
