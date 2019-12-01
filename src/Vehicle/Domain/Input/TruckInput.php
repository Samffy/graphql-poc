<?php

namespace App\Vehicle\Domain\Input;

use App\Vehicle\Domain\VehicleAbstract;

class TruckInput extends VehicleAbstract
{
    protected $id;
    protected $maximumLoad;

    public function __construct(string $id, string $manufacturer, string $model, int $maximumLoad)
    {
        parent::__construct($id, $manufacturer, $model);

        $this->maximumLoad = $maximumLoad;
    }

    public function getMaximumLoad(): int
    {
        return $this->maximumLoad;
    }
}
