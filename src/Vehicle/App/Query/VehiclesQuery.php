<?php

namespace App\Vehicle\App\Query;

class VehiclesQuery
{
    /**
     * @var null|string
     */
    private $personId;

    /**
     * @var null|string
     */
    private $vehicleId;

    /**
     * @param string|null $personId
     * @param string|null $vehicleId
     */
    public function __construct(string $personId = null, string $vehicleId = null)
    {
        $this->personId = $personId;
        $this->vehicleId = $vehicleId;
    }

    /**
     * @return null|string
     */
    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    /**
     * @return bool
     */
    public function hasPersonId(): bool
    {
        return $this->personId !== null;
    }

    /**
     * @return null|string
     */
    public function getVehicleId(): ?string
    {
        return $this->vehicleId;
    }

    /**
     * @return bool
     */
    public function hasVehicleId(): bool
    {
        return $this->vehicleId !== null;
    }
}
