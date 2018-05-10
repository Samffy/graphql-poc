<?php

namespace App\Vehicle\Domain;

interface VehicleRepositoryInterface
{
    /**$
     * @param string $id
     * @return VehicleInterface|null
     */
    public function find(string $id): ?VehicleInterface;
}
