<?php

namespace App\Vehicle\Infra\Repository;

use App\Vehicle\App\Query\VehiclesQuery;
use App\Person\Domain\Person;

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
     * @return array
     */
    public function findByPerson(Person $person): array
    {
        if (array_key_exists($person->getId(), $this->getVehiclesByPersons())) {
            return $this->getVehiclesByPersons()[$person->getId()];
        }

        return [];
    }

    /**
     * @return array
     */
    public function findAll(VehiclesQuery $query): array
    {
        $vehicles = $this->getVehicles();

        if ($query->hasPersonId()) {
            if (array_key_exists($query->getPersonId(), $this->getVehiclesByPersons())) {
                $vehicles = $this->getVehiclesByPersons()[$query->getPersonId()];
            } else {
                $vehicles = [];
            }
        }

        if ($query->hasVehicleId()) {
            $search = $query->getVehicleId();

            return array_filter(
                $vehicles,
                function ($e) use ($search) {
                    return $e->getId() == $search;
                }
            );
        }

        return $vehicles;
    }

    /**
     * @return array
     */
    private function getVehicles(): array
    {
        return [
            $this->carRepository->find('cox'),
            $this->carRepository->find('polo'),
            $this->carRepository->find('clio'),
            $this->truckRepository->find('fear'),
            $this->truckRepository->find('ateam'),
            $this->truckRepository->find('dumb'),
        ];
    }

    /**
     * @return array
     */
    private function getVehiclesByPersons(): array
    {
        return [
            'duffy'  => [
                $this->carRepository->find('cox'),
                $this->truckRepository->find('fear'),
            ],
            'chuck'  => [
                $this->truckRepository->find('ateam'),
            ],
            'milano' => [
                $this->carRepository->find('clio'),
            ],
        ];
    }
}
