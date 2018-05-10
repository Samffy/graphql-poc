<?php

namespace App\Vehicle\Domain;

class Truck implements VehicleInterface
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
    private $maximumLoad;

    /**
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $maximumLoad
     */
    public function __construct(string $id, string $manufacturer, string $model, int $maximumLoad)
    {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->maximumLoad = $maximumLoad;
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
    public function getMaximumLoad(): int
    {
        return $this->maximumLoad;
    }
}
