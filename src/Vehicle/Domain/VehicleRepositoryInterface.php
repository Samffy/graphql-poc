<?php

namespace App\Vehicle\Domain;

interface VehicleRepositoryInterface
{
    public function find(string $id): ?VehicleInterface;

    public function save(VehicleInterface $vehicle): VehicleInterface;

    public function delete(VehicleInterface $vehicle): void;
}
