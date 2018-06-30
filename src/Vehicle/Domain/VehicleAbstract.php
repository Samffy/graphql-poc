<?php

namespace App\Vehicle\Domain;

abstract class VehicleAbstract implements VehicleInterface
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
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     */
    public function __construct(string $id, string $manufacturer, string $model)
    {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
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
     * @param string $manufacturer
     * @return VehicleInterface
     */
    public function setManufacturer(string $manufacturer): VehicleInterface
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return VehicleInterface
     */
    public function setModel(string $model): VehicleInterface
    {
        $this->model = $model;

        return $this;
    }
}
