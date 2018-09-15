<?php

namespace App\Vehicle\Domain;

use App\Vehicle\Domain\Input\TruckInput;

class Truck extends TruckInput
{
    /**
     * @param int $maximumLoad
     * @return Truck
     */
    public function setMaximumLoad(int $maximumLoad): Truck
    {
        $this->maximumLoad = $maximumLoad;

        return $this;
    }
}
