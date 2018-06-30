<?php

namespace App\Vehicle\Domain;

interface VehicleRepositoryInterface
{
    /**$
     * @param string $id
     * @return VehicleInterface|null
     */
    public function find(string $id): ?VehicleInterface;

    /**
     * @param VehicleInterface $vehicle
     * @return VehicleInterface
     */
    public function save(VehicleInterface $vehicle): VehicleInterface;

    /**
     * @param VehicleInterface $vehicle
     */
    public function delete(VehicleInterface $vehicle): void;
}
