<?php

namespace App\Vehicle\Domain;

class Car extends VehicleAbstract
{
    /**
     * @var int
     */
    private $seatsNumber;

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

    /**
     * @param int $seatsNumber
     * @return Car
     */
    public function setSeatsNumber(int $seatsNumber): Car
    {
        $this->seatsNumber = $seatsNumber;

        return $this;
    }
}
