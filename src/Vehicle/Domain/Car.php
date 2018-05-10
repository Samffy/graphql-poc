<?php

namespace App\Vehicle\Domain;

class Car implements VehicleInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $manufacturer;

    /**
     * @var string
     */
    private $model;

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
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->seatsNumber = $seatsNumber;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return int
     */
    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }
}