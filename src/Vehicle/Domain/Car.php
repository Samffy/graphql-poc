<?php

namespace App\Vehicle\Domain;

use App\Vehicle\Domain\Input\CarInput;

class Car extends CarInput
{
    public function setSeatsNumber(int $seatsNumber): Car
    {
        $this->seatsNumber = $seatsNumber;

        return $this;
    }
}
