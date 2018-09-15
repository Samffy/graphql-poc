<?php

namespace App\Vehicle\Domain;

use App\Vehicle\Domain\Input\CarInput;

class Car extends CarInput
{
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
