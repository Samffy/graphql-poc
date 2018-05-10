<?php

namespace App\Vehicle\Domain;

interface VehicleInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getManufacturer(): string;

    /**
     * @return string
     */
    public function getModel(): string;
}
