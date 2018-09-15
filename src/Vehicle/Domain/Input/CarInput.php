<?php

namespace App\Vehicle\Domain\Input;

use App\Vehicle\Domain\VehicleAbstract;

class CarInput extends VehicleAbstract
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $seatsNumber;

    /**
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $seatsNumber
     */
    public function __construct(string $id, string $manufacturer, string $model, int $seatsNumber)
    {
        parent::__construct($id, $manufacturer, $model);

        $this->seatsNumber = $seatsNumber;
    }

    /**
     * @return int
     */
    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }
}
