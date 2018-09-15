<?php

namespace App\Vehicle\Domain\Input;

use App\Vehicle\Domain\VehicleAbstract;

class TruckInput extends VehicleAbstract
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $maximumLoad;

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
