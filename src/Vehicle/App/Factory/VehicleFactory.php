<?php

namespace App\Vehicle\App\Factory;

use App\Common\App\Transformer\AppGlobalId;
use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\Input\CarInput;
use App\Vehicle\Domain\Input\TruckInput;
use App\Vehicle\Domain\Truck;
use Overblog\GraphQLBundle\Definition\Argument;

class VehicleFactory
{
    /**
     * @param Argument $argument
     * @return CarInput
     */
    public static function createCarInput(Argument $argument): CarInput
    {
        $input = $argument->offsetGet('input');

        return new CarInput(
            AppGlobalId::getIdFromGlobalId($input['id']),
            $input['manufacturer'],
            $input['model'],
            $input['seats_number']
        );
    }

    /**
     * @param CarInput $input
     * @return Car
     */
    public static function createCar(CarInput $input): Car
    {
        return new Car(
            $input->getId(),
            $input->getManufacturer(),
            $input->getModel(),
            $input->getSeatsNumber()
        );
    }

    /**
     * @param Argument $argument
     * @return TruckInput
     */
    public static function createTruckInput(Argument $argument): TruckInput
    {
        $input = $argument->offsetGet('input');

        return new TruckInput(
            AppGlobalId::getIdFromGlobalId($input['id']),
            $input['manufacturer'],
            $input['model'],
            $input['maximum_load']
        );
    }

    /**
     * @param TruckInput $input
     * @return Truck
     */
    public static function createTruck(TruckInput $input): Truck
    {
        return new Truck(
            $input->getId(),
            $input->getManufacturer(),
            $input->getModel(),
            $input->getMaximumLoad()
        );
    }
}
