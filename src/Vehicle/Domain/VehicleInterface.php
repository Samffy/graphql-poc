<?php

namespace App\Vehicle\Domain;

interface VehicleInterface
{
    public function getId(): string;

    public function getManufacturer(): string;

    public function getModel(): string;
}
