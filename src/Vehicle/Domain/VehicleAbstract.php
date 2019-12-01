<?php

namespace App\Vehicle\Domain;

abstract class VehicleAbstract implements VehicleInterface
{
    protected $id;
    protected $manufacturer;
    protected $model;

    public function __construct(string $id, string $manufacturer, string $model)
    {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): VehicleInterface
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): VehicleInterface
    {
        $this->model = $model;

        return $this;
    }
}
