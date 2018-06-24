<?php

namespace App\Vehicle\Domain;

class Truck extends VehicleAbstract
{
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
        parent::__construct($id, $manufacturer, $model);

        $this->maximumLoad = $maximumLoad;
    }

    /**
     * @return int
     */
    public function getMaximumLoad(): int
    {
        return $this->maximumLoad;
    }
}
