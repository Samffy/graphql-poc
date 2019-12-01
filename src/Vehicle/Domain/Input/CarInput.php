<?php

namespace App\Vehicle\Domain\Input;

use App\Vehicle\Domain\VehicleAbstract;

class CarInput extends VehicleAbstract
{
    protected $id;
    protected $seatsNumber;

    public function __construct(string $id, string $manufacturer, string $model, int $seatsNumber)
    {
        parent::__construct($id, $manufacturer, $model);

        $this->seatsNumber = $seatsNumber;
    }

    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }
}
